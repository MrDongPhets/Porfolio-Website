
// Contact form - Web3Forms + Database with SweetAlert2
$(document).ready(function() {

    // reviews carousel - dynamic data
function renderReviews(idx){
    const container = $('#carousel').empty();
    
    if (reviews.length === 0) {
    container.html('<p style="text-align:center;color:var(--muted)">No testimonials yet.</p>');
    return;
    }
    
    const per = $(window).width() > 900 ? 2 : 1;
    for(let i=0;i<per;i++){
    const r = reviews[(idx+i) % reviews.length];
    const initials = r.client_name.split(' ').map(s=>s[0]).slice(0,2).join('');
    const stars = '★'.repeat(r.rating);
    
    const card = $(
        `<div class="review-card ${i===0?'active':''}">
        <div class="review-meta">
            <div class="avatar">${initials}</div>
            <div>
            <div class="name">${r.client_name}</div>
            <div class="stars">${stars}</div>
            </div>
        </div>
        <p style="color:var(--muted);margin-top:12px">${r.testimonial}</p>
        </div>`
    );
    container.append(card);
    }
}

let index = 0;
renderReviews(index);
$('#next').on('click', function(){ 
    if(reviews.length > 0) {
    index=(index+1)%reviews.length; 
    renderReviews(index); 
    }
});
$('#prev').on('click', function(){ 
    if(reviews.length > 0) {
    index=(index-1+reviews.length)%reviews.length; 
    renderReviews(index); 
    }
});

// contact form - save to database
$('#contactForm').on('submit', function(e){
    e.preventDefault();
    const name = $('#name').val();
    const email = $('#email').val();
    const message = $('#message').val();
    const submitBtn = $(this).find('button[type="submit"]');
    
    submitBtn.text('Sending...').prop('disabled', true);
    
    // Send to contact handler
    $.ajax({
    url: '<?php echo baseUrl("contact-handler.php"); ?>',
    method: 'POST',
    data: { name, email, message },
    success: function(response) {
        alert('Message sent — thank you, ' + name + '!');
        $('#contactForm')[0].reset();
    },
    error: function(xhr, status, error) {
        console.error('Contact form error:', error);
        alert('Failed to send message. Please try again or email directly.');
    },
    complete: function() {
        submitBtn.text('Send Message').prop('disabled', false);
    }
    });
});

// CTA button click
$('#cta').on('click', function(){
    $('html, body').animate({
    scrollTop: $('#contact').offset().top - 80
    }, 600);
});

// animation on scroll
// $(window).on('scroll resize', function(){
//     $('.review-card').each(function(i,el){
//     const r = $(el).offset().top - $(window).scrollTop();
//     if(r < $(window).height()*0.85) $(el).css('transform','translateY(0)');
//     });
// });


$('#submitContactBtn').on('click', async function(){
        const form = document.getElementById('contactForm');
        
        // Validate form
        if (!form.checkValidity()) {
            form.reportValidity();
            return;
        }
        
        const submitBtn = $(this);
        const originalHtml = submitBtn.html();
        
        submitBtn.html('<span>Sending...</span> <i class="fas fa-spinner fa-spin"></i>').prop('disabled', true);
        
        const formData = new FormData(form);
        
        try {
            // Send to Web3Forms (primary submission)
            const response = await fetch('https://api.web3forms.com/submit', {
                method: 'POST',
                body: formData
            });
            
            const data = await response.json();
            console.log('Web3Forms response:', data);
            
            if (data.success) {
                // Try to save to database (optional, don't fail if this errors)
                try {
                    const dbData = {
                        name: formData.get('name'),
                        email: formData.get('email'),
                        message: formData.get('message')
                    };
                    
                    const dbResponse = await fetch('<?php echo baseUrl("contact-handler.php"); ?>', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded',
                        },
                        body: new URLSearchParams(dbData)
                    });
                    
                    if (dbResponse.ok) {
                        console.log('✓ Message saved to database');
                    } else {
                        console.warn('⚠ Database save failed (non-critical)');
                    }
                } catch (dbError) {
                    // Database save failed, but that's OK - Web3Forms already sent the email
                    console.warn('⚠ Database save error (non-critical):', dbError);
                }
                
                // Show success (Web3Forms succeeded)
                await Swal.fire({
                    icon: 'success',
                    title: 'Message Sent!',
                    html: `<p>Thank you <strong>${formData.get('name')}</strong>!</p>
                           <p>We'll get back to you within 24 hours.</p>`,
                    confirmButtonText: 'Great!',
                    confirmButtonColor: '#EBB92F'
                });
                
                form.reset();
                
            } else {
                throw new Error(data.message || 'Submission failed');
            }
        } catch (error) {
            console.error('Contact form error:', error);
            
            await Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Failed to send message. Please try again or email us directly.',
                confirmButtonText: 'OK',
                confirmButtonColor: '#EBB92F'
            });
        } finally {
            submitBtn.html(originalHtml).prop('disabled', false);
        }
    });
});
