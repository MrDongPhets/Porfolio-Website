import { useState, useEffect, useRef } from 'react';
import { Link, NavLink } from 'react-router-dom';
import '../styles/nav.css';

const SERVICES = [
  { name: 'Web Design & Development',   path: '/services/web-design',        icon: 'fa-laptop-code',  desc: 'Custom websites & web applications' },
  { name: 'Branding & Creative Design', path: '/services/branding',          icon: 'fa-palette',      desc: 'Logo design & brand identity' },
  { name: 'Video Editing & Multimedia', path: '/services/video-editing',     icon: 'fa-video',        desc: 'Social videos & content editing' },
  { name: 'Content Creation & Media',   path: '/services/content-creation',  icon: 'fa-images',       desc: 'Visual content & marketing graphics' },
  { name: 'Administrative Support',     path: '/services/admin-support',     icon: 'fa-user-cog',     desc: 'Virtual assistance & operations' },
];

export default function Navbar() {
  const [scrolled,      setScrolled]      = useState(false);
  const [menuOpen,      setMenuOpen]       = useState(false);
  const [dropdownOpen,  setDropdownOpen]   = useState(false);
  const [theme,         setTheme]          = useState(() => localStorage.getItem('md-theme') || 'dark');
  const dropdownRef = useRef(null);

  // Apply theme to <body>
  useEffect(() => {
    document.body.setAttribute('data-theme', theme);
    localStorage.setItem('md-theme', theme);
  }, [theme]);

  // Scroll detection
  useEffect(() => {
    const onScroll = () => setScrolled(window.scrollY > 50);
    window.addEventListener('scroll', onScroll);
    return () => window.removeEventListener('scroll', onScroll);
  }, []);

  // Close dropdown when clicking outside
  useEffect(() => {
    const handler = (e) => {
      if (dropdownRef.current && !dropdownRef.current.contains(e.target)) {
        setDropdownOpen(false);
      }
    };
    document.addEventListener('click', handler);
    return () => document.removeEventListener('click', handler);
  }, []);

  const closeMenu = () => { setMenuOpen(false); setDropdownOpen(false); };
  const toggleTheme = () => setTheme(t => t === 'light' ? 'dark' : 'light');

  return (
    <header>
      <div className={`nav${scrolled ? ' scrolled' : ''}`}>
        {/* Brand */}
        <div className="brand">
          <Link to="/">
            <div className="logo-img">
              <img src="/assets/mustard.png" alt="Mustard Digitals" />
            </div>
          </Link>
        </div>

        {/* Main nav */}
        <nav className={`main-nav${menuOpen ? ' active' : ''}`} id="mainNav">
          <NavLink to="/"          className="nav-link" end onClick={closeMenu}>Home</NavLink>
          <NavLink to="/about"     className="nav-link" onClick={closeMenu}>About</NavLink>

          {/* Services dropdown */}
          <div
            ref={dropdownRef}
            className={`nav-dropdown${dropdownOpen ? ' active' : ''}`}
          >
            <a
              href="#"
              className="nav-link dropdown-toggle"
              onClick={(e) => { e.preventDefault(); setDropdownOpen(o => !o); }}
            >
              Services <i className="fas fa-chevron-down"></i>
            </a>
            <div className="dropdown-menu">
              <div className="dropdown-grid">
                {SERVICES.map((s) => (
                  <Link key={s.path} to={s.path} className="dropdown-item" onClick={closeMenu}>
                    <div className="dropdown-icon">
                      <i className={`fas ${s.icon}`}></i>
                    </div>
                    <div className="dropdown-content">
                      <h4>{s.name}</h4>
                      <p>{s.desc}</p>
                    </div>
                  </Link>
                ))}
              </div>
            </div>
          </div>

          <NavLink to="/portfolio" className="nav-link" onClick={closeMenu}>Portfolio</NavLink>
          <NavLink to="/contact"   className="nav-link" onClick={closeMenu}>Contact</NavLink>
        </nav>

        {/* Controls */}
        <div className="controls">
          <div className="theme-toggle" onClick={toggleTheme} title="Toggle theme">
            <i className={`fa-solid ${theme === 'light' ? 'fa-moon' : 'fa-sun'}`}></i>
          </div>
          <div
            className={`hamburger${menuOpen ? ' active' : ''}`}
            onClick={() => setMenuOpen(o => !o)}
          >
            <span /><span /><span />
          </div>
        </div>
      </div>
    </header>
  );
}
