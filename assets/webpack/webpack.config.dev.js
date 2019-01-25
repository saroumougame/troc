const path = require('path'), resolve = path.resolve,
    CleanWebpackPlugin = require('clean-webpack-plugin'),
    ExtractTextPlugin = require("extract-text-webpack-plugin");

let outputDirs = {};

module.exports = {
    node: {
        fs: 'empty'
    },
    devtool: "source-map",
    entry: require(resolve(__dirname, '..', 'entry.js')),
    output: {
        filename: (chunkData) => {
            let file = chunkData.chunk.entryModule.rawRequest;
            outputDirs[chunkData.chunk.name] = file.replace(/^\.?\/?src\/?/ig, '');
            return outputDirs[chunkData.chunk.name]
        },
        pathinfo: true,
        path: resolve(__dirname, '..', '..', 'public', 'dist'),
    },
    module: {
        rules: [
            {
                test: /\.jsx?$/,
                exclude: /(node_modules|bower_components)/,
                use: [
                    {
                        loader: 'babel-loader',
                        options: {
                            presets: ['@babel/preset-env', '@babel/react'],
                            sourceMap: true
                        }
                    }
                ]
            },
            {
                test: /\.s?css$/,
                use: ExtractTextPlugin.extract({
                    fallback: "style-loader",
                    use: [
                        {
                            loader: 'css-loader',
                            options: {
                                sourceMap: true
                            }
                        },
                        {
                            loader: 'sass-loader',
                            options: {
                                sourceMap: true
                            }
                        }
                    ]
                })
            },
            {
                test: /\.(png|gif|jpg|jpeg|woff|woff2|eot|ttf|otf|svg)$/i,
                use: [
                    {
                        loader: 'file-loader',
                        options: {
                            name: '[hash].[ext]',
                        }
                    }
                ]
            },
        ]
    },
    plugins: [
        new CleanWebpackPlugin(['dist'], {
            root: resolve(__dirname, '..', '..', 'public')
        }),
        new ExtractTextPlugin({
            filename: (getPath) => {
                return outputDirs[getPath('[name]')].replace(/\.\w+$/ig, '.css');
            },
            allChunks: true,
        })
    ]
};