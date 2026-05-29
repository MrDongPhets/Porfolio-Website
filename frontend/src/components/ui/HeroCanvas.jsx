import { useEffect, useRef } from "react";

export default function HeroCanvas() {
  const canvasRef = useRef(null);

  useEffect(() => {
    const canvas = canvasRef.current;
    if (!canvas) return;

    const ctx = canvas.getContext("2d");

    let animationFrame;
    let t = 0;

    const mouse = {
      x: null,
      y: null,
    };

    // ==========================================
    // RESPONSIVE RETINA RESIZE
    // ==========================================

    const resize = () => {
      const dpr =
        window.devicePixelRatio || 1;

      const width = window.innerWidth;
      const height = window.innerHeight;

      // actual canvas pixels
      canvas.width = width * dpr;
      canvas.height = height * dpr;

      // visual size
      canvas.style.width = `${width}px`;
      canvas.style.height = `${height}px`;

      // reset transform
      ctx.setTransform(1, 0, 0, 1, 0, 0);

      // scale everything back down
      ctx.scale(dpr, dpr);
    };

    resize();

    window.addEventListener(
      "resize",
      resize
    );

    // ==========================================
    // MOUSE EVENTS
    // ==========================================

    const handleMouseMove = (e) => {
      mouse.x = e.clientX;
      mouse.y = e.clientY;
    };

    const handleMouseLeave = () => {
      mouse.x = null;
      mouse.y = null;
    };

    window.addEventListener(
      "mousemove",
      handleMouseMove
    );

    window.addEventListener(
      "mouseleave",
      handleMouseLeave
    );

    // ==========================================
    // PARTICLES
    // ==========================================

    const particleCount =
      window.innerWidth < 768
        ? 70
        : 140;

    const particles = Array.from(
      { length: particleCount },
      () => {
        return {
          x: Math.random(),
          y: Math.random(),

          size:
            window.innerWidth < 768
              ? Math.random() * 2 + 0.5
              : Math.random() * 3 + 0.8,

          opacity:
            Math.random() * 0.5 + 0.08,

          drift:
            Math.random() * 0.00016 +
            0.00003,

          phase:
            Math.random() *
            Math.PI *
            2,
        };
      }
    );

    // ==========================================
    // DRAW PARTICLES
    // ==========================================

    function drawParticles() {
      const W = window.innerWidth;
      const H = window.innerHeight;

      particles.forEach((p) => {
        let x =
          (p.x +
            Math.sin(
              t + p.phase
            ) *
              0.01) *
          W;

        let y =
          ((p.y + t * p.drift) % 1) *
          H;

        // =========================
        // MOUSE MAGNET EFFECT
        // =========================

        if (
          mouse.x !== null &&
          mouse.y !== null
        ) {
          const dx = mouse.x - x;
          const dy = mouse.y - y;

          const dist = Math.sqrt(
            dx * dx + dy * dy
          );

          const radius = 140;

          if (dist < radius) {
            const force =
              (1 - dist / radius) *
              0.08;

            x += dx * force * 0.08;
            y += dy * force * 0.08;
          }
        }

        const alpha =
          p.opacity *
          (0.65 +
            Math.sin(
              t * 1.8 + p.phase
            ) *
              0.35);

        ctx.save();

        ctx.translate(x, y);

        ctx.rotate(
          t * 0.08 + p.phase
        );

        // glow
        ctx.shadowColor =
          "rgba(235,185,47,0.7)";

        ctx.shadowBlur = 6;

        ctx.fillStyle = `rgba(235,185,47,${alpha})`;

        // squares
        if (p.size > 2.2) {
          ctx.fillRect(
            -p.size / 2,
            -p.size / 2,
            p.size,
            p.size
          );
        }

        // circles
        else {
          ctx.beginPath();

          ctx.arc(
            0,
            0,
            p.size * 0.5,
            0,
            Math.PI * 2
          );

          ctx.fill();
        }

        ctx.restore();
      });
    }

    // ==========================================
    // GLOW
    // ==========================================

    function drawGlow() {
      const W = window.innerWidth;
      const H = window.innerHeight;

      const glow =
        ctx.createRadialGradient(
          W / 2,
          H * 0.12,
          0,
          W / 2,
          H * 0.12,
          H * 0.7
        );

      glow.addColorStop(
        0,
        "rgba(235,185,47,0.08)"
      );

      glow.addColorStop(
        1,
        "rgba(0,0,0,0)"
      );

      ctx.fillStyle = glow;

      ctx.fillRect(0, 0, W, H);
    }

    // ==========================================
    // ANIMATION
    // ==========================================

    function animate() {
      const W = window.innerWidth;
      const H = window.innerHeight;

      ctx.clearRect(0, 0, W, H);

      t += 0.035;

      drawGlow();

      drawParticles();

      animationFrame =
        requestAnimationFrame(
          animate
        );
    }

    animate();

    // ==========================================
    // CLEANUP
    // ==========================================

    return () => {
      cancelAnimationFrame(
        animationFrame
      );

      window.removeEventListener(
        "resize",
        resize
      );

      window.removeEventListener(
        "mousemove",
        handleMouseMove
      );

      window.removeEventListener(
        "mouseleave",
        handleMouseLeave
      );
    };
  }, []);

  return (
    <canvas
      ref={canvasRef}
      className="hero-canvas-bg"
    />
  );
}