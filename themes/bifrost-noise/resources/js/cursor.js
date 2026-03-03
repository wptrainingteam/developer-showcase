/**
 * NOISE — Custom Cursor
 * Drop-in cursor script for the Noise underground music site.
 *
 * Usage:
 *   1. Link the stylesheet in your <head>:
 *        <link rel="stylesheet" href="noise-cursor.css">
 *
 *   2. Include this script (before </body> or with defer):
 *        <script src="noise-cursor.js" defer></script>
 *
 *      That's it — no HTML changes needed. The script injects its own elements.
 *
 *   3. To trigger the hover effect on dynamically added elements:
 *        window.NoiseCursor.bindHover(myNewElement)
 */

(function () {
	function init() {
		const ring = document.createElement('div');
		const dot  = document.createElement('div');
		ring.id = 'cursor-ring';
		dot.id  = 'cursor-dot';
		document.body.appendChild(ring);
		document.body.appendChild(dot);

		let mouseX = 0, mouseY = 0;
		let ringX  = 0, ringY  = 0;
		let lastX  = 0, lastY  = 0;
		let trailCount = 0;
		const MAX_TRAIL = 20;
		let colorIdx = 0;

		const TRAIL_COLORS = [
			'rgba(168,85,247,',   // purple-500
			'rgba(192,132,252,',  // purple-400
			'rgba(139,92,246,',   // violet-500
			'rgba(168,85,247,',
			'rgba(192,132,252,',
		];

		const GLYPHS = [
			'◈', '▓', '░', '▒', '⟁', '⌇', '⍭', '⌬', '⍉', '⌖',
			'NOISE', '█▒░', '⌗', '⍟', '◉', '▲▼', '////', '\\\\',
			'∿∿', '⌁⌁', 'RAW', 'LOUD', '404', 'ERR_', '##', '??',
		];

		// ── Mouse tracking ──────────────────────────────────────────────────────────

		document.addEventListener('mousemove', (e) => {
			mouseX = e.clientX;
			mouseY = e.clientY;

			const dx = mouseX - lastX;
			const dy = mouseY - lastY;
			const speed = Math.sqrt(dx * dx + dy * dy);

			if (speed > 4 && trailCount < MAX_TRAIL) spawnTrail(mouseX, mouseY, speed);

			lastX = mouseX;
			lastY = mouseY;

			dot.style.left = mouseX + 'px';
			dot.style.top  = mouseY + 'px';
		});

		// ── Smooth ring follow ───────────────────────────────────────────────────────

		(function animateRing() {
			ringX += (mouseX - ringX) * 0.22;
			ringY += (mouseY - ringY) * 0.22;
			ring.style.left = ringX + 'px';
			ring.style.top  = ringY + 'px';
			requestAnimationFrame(animateRing);
		})();

		// ── Click effects ────────────────────────────────────────────────────────────

		document.addEventListener('click', (e) => {
			// Ring bloom
			ring.classList.add('clicked');
			setTimeout(() => ring.classList.remove('clicked'), 250);

			// Double ripple
			spawnRipple(e.clientX, e.clientY, 0,   'rgba(168,85,247,1)');
			spawnRipple(e.clientX, e.clientY, 100, 'rgba(139,92,246,0.5)');

			// Floating glyphs
			const count = 3 + Math.floor(Math.random() * 3);
			for (let i = 0; i < count; i++) {
				setTimeout(() => spawnGlyph(e.clientX, e.clientY), i * 60);
			}

			// Radial particle burst
			for (let i = 0; i < 8; i++) {
				const angle = (i / 8) * Math.PI * 2;
				const dist  = 20 + Math.random() * 30;
				setTimeout(() => {
					spawnTrail(
						e.clientX + Math.cos(angle) * dist,
						e.clientY + Math.sin(angle) * dist,
						15
					);
				}, i * 20);
			}
		});

		// ── Hover on interactive elements ────────────────────────────────────────────

		function bindHover(el) {
			el.addEventListener('mouseenter', () => {
				ring.classList.add('hovering');
				dot.style.transform = 'translate(-50%, -50%) scale(1.8)';
			});
			el.addEventListener('mouseleave', () => {
				ring.classList.remove('hovering');
				dot.style.transform = 'translate(-50%, -50%) scale(1)';
			});
		}

		// Bind default interactive selectors + anything with data-cursor-hover
		document.querySelectorAll(
			'a, button, input, select, textarea, [role="button"], [data-cursor-hover]'
		).forEach(bindHover);

		// Re-export so you can bind new elements added dynamically:
		//   window.NoiseCursor.bindHover(myNewElement)
		window.NoiseCursor = { bindHover };

		// ── Helpers ──────────────────────────────────────────────────────────────────

		function spawnTrail(x, y, speed) {
			const el = document.createElement('div');
			el.className = 'cursor-trail';
			trailCount++;

			const size     = Math.min(3 + speed * 0.2, 9);
			const color    = TRAIL_COLORS[colorIdx++ % TRAIL_COLORS.length];
			const opacity  = Math.min(0.12 + speed * 0.012, 0.45);
			const duration = 300 + Math.random() * 300;
			const shape    = Math.random() > 0.7 ? '3px' : '50%';

			el.style.cssText = `
      left:${x}px; top:${y}px;
      width:${size}px; height:${size}px;
      background:${color}${opacity});
      border-radius:${shape};
      animation-duration:${duration}ms;
    `;

			document.body.appendChild(el);
			setTimeout(() => { el.remove(); trailCount--; }, duration);
		}

		function spawnRipple(x, y, delay, color) {
			const el = document.createElement('div');
			el.className = 'cursor-ripple';
			el.style.cssText = `
      left:${x}px; top:${y}px;
      width:40px; height:40px;
      border-color:${color};
      animation-delay:${delay}ms;
    `;
			document.body.appendChild(el);
			setTimeout(() => el.remove(), 500 + delay);
		}

		function spawnGlyph(x, y) {
			const el = document.createElement('div');
			el.className   = 'cursor-glyph';
			el.textContent = GLYPHS[Math.floor(Math.random() * GLYPHS.length)];

			const offsetX  = (Math.random() - 0.5) * 60;
			const duration = 700 + Math.random() * 400;
			const hue      = Math.random() > 0.5 ? '#a855f7' : '#c084fc';

			el.style.cssText = `
      left:${x + offsetX}px; top:${y}px;
      animation-duration:${duration}ms;
      color:${hue};
      opacity:${0.6 + Math.random() * 0.4};
    `;

			document.body.appendChild(el);
			setTimeout(() => el.remove(), duration);
		}

	} // end init()

	if (document.readyState === 'loading') {
		document.addEventListener('DOMContentLoaded', init);
	} else {
		init();
	}
})();
