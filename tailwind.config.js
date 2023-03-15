/** @type {import('tailwindcss').Config} */
module.exports = {
	mode: "jit",
	content: [
		"./public/**/*.html",
		"./src/**/*.{html,astro,js,jsx,ts,tsx,vue}",
		"./pages/**/*.{html,js}",
		"./components/**/*.{html,js}",
	],
	theme: {
		extend: {
			colors: {
				background: "#f5f5f5",
				foreground: "#4f565d",
				neutral: {
					50: "#fafafa",
					100: "#f4f5f7",
					200: "#e5e8ea",
					300: "#d3d7db",
					400: "#a0a5ab",
					500: "#6f757b",
					600: "#4f565d",
					700: "#3b4249",
					800: "#22282f",
					900: "#13191f",
				},
				fiorenza: {
					DEFAULT: "#d2c2ba",
					50: "#fafaf9",
					100: "#f0efee",
					200: "#e0dad8",
					300: "#d2c2ba",
					400: "#ad9488",
					500: "#7e685c",
					600: "#594f45",
					700: "#453d37",
					800: "#292423",
					900: "#1c1917",
				},
			},
		},
	},
	plugins: [],
};
