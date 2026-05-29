import '../styles/brand-marquee.css';
const brandModules = import.meta.glob('../assets/brands/*', {
  eager: true,
});
const BRANDS = Object.entries(brandModules).map(([path, mod]) => ({
  name: path.split('/').pop().replace(/\.[^.]+$/, ''),
  logo: mod.default,
}));

// Fallback to Mustard logo if folder is empty
import mustardLogo from '../assets/mustard.png';
const DISPLAY_BRANDS = BRANDS.length > 0 ? BRANDS : Array(8).fill({ name: 'Placeholder', logo: mustardLogo });

export default function BrandMarquee() {
  return (
    <div className="marquee-section">
      <div className="marquee-track-wrapper">
        <div className="marquee-fade marquee-fade-left" />
        <div className="marquee-track">
          {[...DISPLAY_BRANDS, ...DISPLAY_BRANDS].map((brand, i) => (
            <div className="marquee-item" key={i}>
              <img src={brand.logo} alt={brand.name} className="marquee-logo" />
            </div>
          ))}
        </div>
        <div className="marquee-fade marquee-fade-right" />
      </div>
    </div>
  );
}