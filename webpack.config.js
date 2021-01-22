const path = require( 'path' );
const MiniCssExtractPlugin = require( 'mini-css-extract-plugin' );
const TerserPlugin = require( 'terser-webpack-plugin' );
const CssMinimizerPlugin = require( 'css-minimizer-webpack-plugin' );
const { CleanWebpackPlugin } = require( 'clean-webpack-plugin' );
// JS Directory path.
const JS_DIR = path.resolve( __dirname, 'assets/src/js' );
const BUILD_DIR = path.resolve( __dirname, 'assets/dist' );

module.exports = ( env, options ) => {

	const mode = options.mode || 'development';

	const extPrefix = ( mode === 'production' ) ? '.min' : '';

	const config = {
		mode,
		entry: {
			script: './assets/src/js/script.js',
			styles: './assets/src/css/styles.scss'
		},
		output: {
			path: path.resolve( __dirname, BUILD_DIR ),
			filename: `[name]${extPrefix}.js`,
		},
		module: {
			rules: [
				{
					test: /\.js$/,
					include: [ JS_DIR ],
					exclude: /node_modules/,
					use: 'babel-loader'
				},
				{
					test: /\.(sa|sc|c)ss$/,
					use: [
						MiniCssExtractPlugin.loader,
						'css-loader',
						'sass-loader',
					],
				},
			]
		},
		plugins: [
			new CleanWebpackPlugin( {
				cleanStaleWebpackAssets: ( mode === 'production' ) // Automatically remove all unused webpack assets on rebuild, when set to true in production.
			} ),
			new MiniCssExtractPlugin( {
				filename: `[name]${extPrefix}.css`,
			} ),
		],
		optimization: {
			minimize: true,
			minimizer: [
				new TerserPlugin( {
					terserOptions: {},
					minify: ( file ) => {
						const uglifyJsOptions = {
							sourceMap: true
						};
						return require( 'uglify-js' ).minify( file, uglifyJsOptions );
					},
				} ),
				new CssMinimizerPlugin()
			],
		},
		externals: {
			'@wordpress/api-fetch': ['wp', 'apiFetch'],
			'@wordpress/i18n': ['wp', 'i18n'],
		},
		devtool: 'source-map',
	}

	return config;
}