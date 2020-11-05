const path = require('path');


module.exports = {
	entry: path.resolve('resources', 'assets', 'js', 'app.components.js'),
	output: {
		filename: 'app.bundle.js',
		path: path.resolve(__dirname, 'public/assets/js')
	},

	module: {
		rules: [
			{
				test: /\.vue$/,
				loader: 'vue-loader',
				exclude: /(node_modules)/
			}

		]
	}


}