<?php
// config/database.php - Supabase Database Connection

class SupabaseClient {
    private $url;
    private $key;
    private $headers;
    
    public function __construct($url, $key) {
        $this->url = rtrim($url, '/');
        $this->key = $key;
        $this->headers = [
            'apikey: ' . $key,
            'Authorization: Bearer ' . $key,
            'Content-Type: application/json',
            'Prefer: return=representation'
        ];
    }
    
    /**
     * Execute a SELECT query
     */
    public function select($table, $columns = '*', $filters = [], $order = null, $limit = null) {
        $url = $this->url . '/rest/v1/' . $table . '?select=' . $columns;
        
        // Add filters
        foreach ($filters as $key => $value) {
            if (is_array($value)) {
                // Handle operators like ['eq', 'value'] or ['gt', 5]
                $operator = $value[0];
                $val = $value[1];
                $url .= '&' . $key . '=' . $operator . '.' . urlencode($val);
            } else {
                // Default to equality
                $url .= '&' . $key . '=eq.' . urlencode($value);
            }
        }
        
        // Add ordering
        if ($order) {
            $url .= '&order=' . $order;
        }
        
        // Add limit
        if ($limit) {
            $url .= '&limit=' . $limit;
        }
        
        return $this->request('GET', $url);
    }
    
    /**
     * Execute an INSERT query
     */
    public function insert($table, $data) {
        $url = $this->url . '/rest/v1/' . $table;
        return $this->request('POST', $url, $data);
    }
    
    /**
     * Execute an UPDATE query
     */
    public function update($table, $data, $filters = []) {
        $url = $this->url . '/rest/v1/' . $table;
        
        // Add filters
        $filterStr = '';
        foreach ($filters as $key => $value) {
            if ($filterStr) $filterStr .= '&';
            $filterStr .= $key . '=eq.' . urlencode($value);
        }
        
        if ($filterStr) {
            $url .= '?' . $filterStr;
        }
        
        return $this->request('PATCH', $url, $data);
    }
    
    /**
     * Execute a DELETE query
     */
    public function delete($table, $filters = []) {
        $url = $this->url . '/rest/v1/' . $table;
        
        // Add filters
        $filterStr = '';
        foreach ($filters as $key => $value) {
            if ($filterStr) $filterStr .= '&';
            $filterStr .= $key . '=eq.' . urlencode($value);
        }
        
        if ($filterStr) {
            $url .= '?' . $filterStr;
        }
        
        return $this->request('DELETE', $url);
    }
    
    /**
     * Execute a raw SQL query using RPC
     */
    public function rpc($functionName, $params = []) {
        $url = $this->url . '/rest/v1/rpc/' . $functionName;
        return $this->request('POST', $url, $params);
    }
    
    /**
     * Make HTTP request to Supabase
     */
    private function request($method, $url, $data = null) {
        $ch = curl_init();
        
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $this->headers);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
        
        // Disable SSL verification for local development
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        
        if ($data !== null && ($method === 'POST' || $method === 'PATCH')) {
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        }
        
        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $error = curl_error($ch);
        
        curl_close($ch);
        
        if ($error) {
            return ['error' => $error, 'success' => false];
        }
        
        $decoded = json_decode($response, true);
        
        if ($httpCode >= 200 && $httpCode < 300) {
            return ['data' => $decoded, 'success' => true];
        } else {
            return ['error' => $decoded, 'success' => false, 'code' => $httpCode];
        }
    }
    
    /**
     * Upload file to Supabase Storage
     */
    public function uploadFile($bucket, $path, $file) {
        $url = $this->url . '/storage/v1/object/' . $bucket . '/' . $path;
        
        // Read file content
        $fileContent = file_get_contents($file['tmp_name']);
        $mimeType = mime_content_type($file['tmp_name']);
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'apikey: ' . $this->key,
            'Authorization: Bearer ' . $this->key,
            'Content-Type: ' . $mimeType,
            'x-upsert: true'
        ]);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fileContent);
        
        // Disable SSL verification for local development
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        
        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $curlError = curl_error($ch);
        curl_close($ch);
        
        // Return detailed error information
        if ($curlError) {
            return ['success' => false, 'error' => 'CURL Error: ' . $curlError];
        }
        
        if ($httpCode >= 200 && $httpCode < 300) {
            return ['success' => true, 'data' => json_decode($response, true)];
        } else {
            $errorData = json_decode($response, true);
            return [
                'success' => false, 
                'error' => 'HTTP ' . $httpCode . ': ' . ($errorData['message'] ?? $response),
                'details' => $errorData
            ];
        }
    }
    
    /**
     * Get public URL for a file
     */
    public function getPublicUrl($bucket, $path) {
        return $this->url . '/storage/v1/object/public/' . $bucket . '/' . $path;
    }
}

// Initialize Supabase client
function getSupabaseClient($useServiceKey = false) {
    static $client = null;
    static $serviceClient = null;
    
    // Load environment variables
    $envFile = __DIR__ . '/../.env';
    if (file_exists($envFile)) {
        $lines = file($envFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        foreach ($lines as $line) {
            if (strpos(trim($line), '#') === 0) continue;
            list($key, $value) = explode('=', $line, 2);
            putenv(trim($key) . '=' . trim($value));
        }
    }
    
    $url = getenv('SUPABASE_URL');
    
    // Use service key for admin operations, anon key for public
    if ($useServiceKey) {
        if ($serviceClient === null) {
            $serviceKey = getenv('SUPABASE_SERVICE_KEY');
            if (!$serviceKey) {
                die('Service key not found. Please add SUPABASE_SERVICE_KEY to .env file.');
            }
            $serviceClient = new SupabaseClient($url, $serviceKey);
        }
        return $serviceClient;
    } else {
        if ($client === null) {
            $key = getenv('SUPABASE_KEY');
            if (!$url || !$key) {
                die('Supabase credentials not found. Please check your .env file.');
            }
            $client = new SupabaseClient($url, $key);
        }
        return $client;
    }
}

// Helper function for database operations
// Default uses anon key (for public access like login)
$db = getSupabaseClient(false);