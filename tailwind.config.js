module.exports = {
  future: {
    removeDeprecatedGapUtilities: true,
    purgeLayersByDefault: true,
  },
  purge: [
      './templates/**/*.twig',
      './assets/js/**/*.js',
      './assets/sass/**/*.sass'
  ],
  theme: {
    extend: {},
  },
  variants: {},
  plugins: [],
}
