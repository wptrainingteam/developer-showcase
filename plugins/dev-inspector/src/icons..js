// DeveloperModeIcons.jsx
/**
 * Option 3: Code Toggle (Recommended)
 * Code brackets with toggle switch and slash
 */
const CodeToggleIcon = ({
	size = 24,
	color = "currentColor",
	strokeWidth = 2,
	className = "",
	...props
}) => {
	return (
		<svg
			xmlns="http://www.w3.org/2000/svg"
			viewBox="0 0 24 24"
			width={size}
			height={size}
			fill="none"
			stroke={color}
			strokeWidth={strokeWidth}
			strokeLinecap="round"
			strokeLinejoin="round"
			className={className}
			{...props}
		>
			<polyline points="7 8 3 12 7 16" />
			<polyline points="17 8 21 12 17 16" />
			<rect x="9" y="10" width="6" height="4" rx="2" fill={color} />
			<line x1="10" y1="5" x2="14" y2="19" />
		</svg>
	);
};

export default CodeToggleIcon;
