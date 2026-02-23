import { BrowserRouter, Routes, Route, useLocation } from 'react-router-dom';
import { useEffect } from 'react';
import AOS from 'aos';
import 'aos/dist/aos.css';

import Navbar       from './components/Navbar';
import Footer       from './components/Footer';
import ScrollToTop  from './components/ScrollToTop';

import Home            from './pages/Home';
import Portfolio       from './pages/Portfolio';
import PortfolioDetail from './pages/PortfolioDetail';
import Services        from './pages/Services';
import About           from './pages/About';
import Contact         from './pages/Contact';
import NotFound        from './pages/NotFound';

import WebDesign        from './pages/services/WebDesign';
import Branding         from './pages/services/Branding';
import VideoEditing     from './pages/services/VideoEditing';
import ContentCreation  from './pages/services/ContentCreation';
import AdminSupport     from './pages/services/AdminSupport';

function AOSInit() {
  const location = useLocation();
  useEffect(() => {
    AOS.init({ duration: 800, easing: 'ease-in-out', once: false, offset: 100 });
  }, []);
  useEffect(() => {
    AOS.refreshHard();
  }, [location]);
  return null;
}

export default function App() {
  return (
    <BrowserRouter>
      <AOSInit />
      <Navbar />
      <Routes>
        <Route path="/"               element={<Home />} />
        <Route path="/portfolio"      element={<Portfolio />} />
        <Route path="/portfolio/:id"  element={<PortfolioDetail />} />
        <Route path="/services"                      element={<Services />} />
        <Route path="/services/web-design"          element={<WebDesign />} />
        <Route path="/services/branding"            element={<Branding />} />
        <Route path="/services/video-editing"       element={<VideoEditing />} />
        <Route path="/services/content-creation"    element={<ContentCreation />} />
        <Route path="/services/admin-support"       element={<AdminSupport />} />
        <Route path="/about"          element={<About />} />
        <Route path="/contact"        element={<Contact />} />
        <Route path="*"               element={<NotFound />} />
      </Routes>
      <Footer />
      <ScrollToTop />
    </BrowserRouter>
  );
}
