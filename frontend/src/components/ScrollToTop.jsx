import { useState, useEffect } from 'react';
import { useLocation } from 'react-router-dom';

export default function ScrollToTop() {
  const [visible, setVisible] = useState(false);
  const { pathname } = useLocation();

  // Reset scroll position on every route change
  useEffect(() => {
    window.scrollTo(0, 0);
  }, [pathname]);

  useEffect(() => {
    const onScroll = () => setVisible(window.scrollY > 300);
    window.addEventListener('scroll', onScroll);
    return () => window.removeEventListener('scroll', onScroll);
  }, []);

  return (
    <button
      className={`scroll-top${visible ? ' visible' : ''}`}
      onClick={() => window.scrollTo({ top: 0, behavior: 'smooth' })}
      aria-label="Scroll to top"
    >
      ↑
    </button>
  );
}
