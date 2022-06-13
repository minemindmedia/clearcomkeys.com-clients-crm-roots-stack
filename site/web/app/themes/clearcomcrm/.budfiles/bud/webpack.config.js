module.exports = {
  "bail": true,
  "cache": {
    "name": "bud.production",
    "type": "filesystem",
    "version": "i7rvkz4gwckypuusyuil03dwfjw_",
    "cacheDirectory": "/Users/minemindmedia/Development/trellis.clients.clearcom.build/site/web/app/themes/clearcomcrm/.budfiles/cache/webpack",
    "managedPaths": [
      "/Users/minemindmedia/Development/trellis.clients.clearcom.build/site/web/app/themes/clearcomcrm/node_modules"
    ],
    "buildDependencies": {
      "bud": [
        "/Users/minemindmedia/Development/trellis.clients.clearcom.build/site/web/app/themes/clearcomcrm/package.json",
        "/Users/minemindmedia/Development/trellis.clients.clearcom.build/site/web/app/themes/clearcomcrm/.editorconfig",
        "/Users/minemindmedia/Development/trellis.clients.clearcom.build/site/web/app/themes/clearcomcrm/bud.config.js",
        "/Users/minemindmedia/Development/trellis.clients.clearcom.build/site/web/app/themes/clearcomcrm/composer.json",
        "/Users/minemindmedia/Development/trellis.clients.clearcom.build/site/web/app/themes/clearcomcrm/jsconfig.json",
        "/Users/minemindmedia/Development/trellis.clients.clearcom.build/site/web/app/themes/clearcomcrm/tailwind.config.js",
        "/Users/minemindmedia/Development/trellis.clients.clearcom.build/site/web/app/themes/clearcomcrm/theme.json"
      ]
    }
  },
  "context": "/Users/minemindmedia/Development/trellis.clients.clearcom.build/site/web/app/themes/clearcomcrm",
  "infrastructureLogging": {
    "console": {
      "Console": {}
    }
  },
  "mode": "production",
  "module": {
    "noParse": {},
    "rules": [
      {
        "test": {},
        "parser": {
          "requireEnsure": false
        }
      },
      {
        "oneOf": [
          {
            "test": {},
            "use": [
              {
                "loader": "/Users/minemindmedia/Development/trellis.clients.clearcom.build/site/web/app/themes/clearcomcrm/node_modules/babel-loader/lib/index.js",
                "options": {
                  "presets": [
                    [
                      "/Users/minemindmedia/Development/trellis.clients.clearcom.build/site/web/app/themes/clearcomcrm/node_modules/@babel/preset-env/lib/index.js"
                    ],
                    [
                      "/Users/minemindmedia/Development/trellis.clients.clearcom.build/site/web/app/themes/clearcomcrm/node_modules/@babel/preset-react/lib/index.js"
                    ]
                  ],
                  "plugins": [
                    [
                      "/Users/minemindmedia/Development/trellis.clients.clearcom.build/site/web/app/themes/clearcomcrm/node_modules/@babel/plugin-transform-runtime/lib/index.js",
                      {
                        "helpers": false
                      }
                    ],
                    [
                      "/Users/minemindmedia/Development/trellis.clients.clearcom.build/site/web/app/themes/clearcomcrm/node_modules/@babel/plugin-proposal-object-rest-spread/lib/index.js"
                    ],
                    [
                      "/Users/minemindmedia/Development/trellis.clients.clearcom.build/site/web/app/themes/clearcomcrm/node_modules/@babel/plugin-syntax-dynamic-import/lib/index.js"
                    ],
                    [
                      "/Users/minemindmedia/Development/trellis.clients.clearcom.build/site/web/app/themes/clearcomcrm/node_modules/@babel/plugin-proposal-class-properties/lib/index.js"
                    ]
                  ]
                }
              }
            ],
            "include": [
              "/Users/minemindmedia/Development/trellis.clients.clearcom.build/site/web/app/themes/clearcomcrm/resources"
            ]
          },
          {
            "test": {},
            "use": [
              {
                "loader": "/Users/minemindmedia/Development/trellis.clients.clearcom.build/site/web/app/themes/clearcomcrm/node_modules/mini-css-extract-plugin/dist/loader.js"
              },
              {
                "loader": "/Users/minemindmedia/Development/trellis.clients.clearcom.build/site/web/app/themes/clearcomcrm/node_modules/css-loader/dist/cjs.js",
                "options": {
                  "importLoaders": 1,
                  "sourceMap": false
                }
              },
              {
                "loader": "/Users/minemindmedia/Development/trellis.clients.clearcom.build/site/web/app/themes/clearcomcrm/node_modules/postcss-loader/dist/cjs.js",
                "options": {
                  "postcssOptions": {
                    "plugins": [
                      [
                        "/Users/minemindmedia/Development/trellis.clients.clearcom.build/site/web/app/themes/clearcomcrm/node_modules/postcss-import/index.js"
                      ],
                      [
                        null
                      ],
                      [
                        null
                      ],
                      [
                        "/Users/minemindmedia/Development/trellis.clients.clearcom.build/site/web/app/themes/clearcomcrm/node_modules/postcss-preset-env/dist/index.cjs",
                        {
                          "stage": 1,
                          "features": {
                            "focus-within-pseudo-class": false
                          }
                        }
                      ]
                    ]
                  },
                  "sourceMap": true
                }
              }
            ],
            "include": [
              "/Users/minemindmedia/Development/trellis.clients.clearcom.build/site/web/app/themes/clearcomcrm/resources"
            ]
          },
          {
            "test": {},
            "use": [
              {
                "loader": "/Users/minemindmedia/Development/trellis.clients.clearcom.build/site/web/app/themes/clearcomcrm/node_modules/mini-css-extract-plugin/dist/loader.js"
              },
              {
                "loader": "/Users/minemindmedia/Development/trellis.clients.clearcom.build/site/web/app/themes/clearcomcrm/node_modules/css-loader/dist/cjs.js",
                "options": {
                  "importLoaders": 1,
                  "localIdentName": "[name]__[local]___[hash:base64:5]",
                  "modules": true,
                  "sourceMap": false
                }
              }
            ],
            "include": [
              "/Users/minemindmedia/Development/trellis.clients.clearcom.build/site/web/app/themes/clearcomcrm/resources"
            ]
          },
          {
            "test": {},
            "include": [
              "/Users/minemindmedia/Development/trellis.clients.clearcom.build/site/web/app/themes/clearcomcrm/resources"
            ],
            "type": "asset/resource",
            "generator": {
              "filename": "images/[name].[contenthash:6][ext]"
            }
          },
          {
            "test": {},
            "include": [
              "/Users/minemindmedia/Development/trellis.clients.clearcom.build/site/web/app/themes/clearcomcrm/resources"
            ],
            "type": "asset/resource",
            "generator": {
              "filename": "images/[name].[contenthash:6][ext]"
            }
          },
          {
            "test": {},
            "include": [
              "/Users/minemindmedia/Development/trellis.clients.clearcom.build/site/web/app/themes/clearcomcrm/resources"
            ],
            "type": "asset/resource",
            "generator": {
              "filename": "images/[name].[contenthash:6][ext]"
            }
          },
          {
            "test": {},
            "include": [
              "/Users/minemindmedia/Development/trellis.clients.clearcom.build/site/web/app/themes/clearcomcrm/resources"
            ],
            "type": "asset",
            "generator": {
              "filename": "fonts/[name].[contenthash:6][ext]"
            }
          },
          {
            "test": {},
            "include": [
              "/Users/minemindmedia/Development/trellis.clients.clearcom.build/site/web/app/themes/clearcomcrm/resources"
            ],
            "type": "json",
            "parser": {}
          },
          {
            "test": {},
            "include": [
              "/Users/minemindmedia/Development/trellis.clients.clearcom.build/site/web/app/themes/clearcomcrm/resources"
            ],
            "type": "json",
            "parser": {}
          },
          {
            "test": {},
            "use": [
              {
                "loader": "/Users/minemindmedia/Development/trellis.clients.clearcom.build/site/web/app/themes/clearcomcrm/node_modules/html-loader/dist/cjs.js"
              }
            ],
            "include": [
              "/Users/minemindmedia/Development/trellis.clients.clearcom.build/site/web/app/themes/clearcomcrm/resources"
            ]
          },
          {
            "test": {},
            "use": [
              {
                "loader": "/Users/minemindmedia/Development/trellis.clients.clearcom.build/site/web/app/themes/clearcomcrm/node_modules/csv-loader/index.js"
              }
            ],
            "include": [
              "/Users/minemindmedia/Development/trellis.clients.clearcom.build/site/web/app/themes/clearcomcrm/resources"
            ]
          },
          {
            "test": {},
            "use": [
              {
                "loader": "/Users/minemindmedia/Development/trellis.clients.clearcom.build/site/web/app/themes/clearcomcrm/node_modules/xml-loader/index.js"
              }
            ],
            "include": [
              "/Users/minemindmedia/Development/trellis.clients.clearcom.build/site/web/app/themes/clearcomcrm/resources"
            ]
          },
          {
            "test": {},
            "include": [
              "/Users/minemindmedia/Development/trellis.clients.clearcom.build/site/web/app/themes/clearcomcrm/resources"
            ],
            "type": "json",
            "parser": {}
          }
        ]
      }
    ],
    "unsafeCache": false
  },
  "name": "bud",
  "node": false,
  "output": {
    "assetModuleFilename": "[name].[contenthash:6][ext]",
    "chunkFilename": "[name].[contenthash:6].js",
    "filename": "[name].[contenthash:6].js",
    "path": "/Users/minemindmedia/Development/trellis.clients.clearcom.build/site/web/app/themes/clearcomcrm/public",
    "pathinfo": false,
    "publicPath": ""
  },
  "optimization": {
    "emitOnErrors": false,
    "minimize": true,
    "minimizer": [
      "...",
      {
        "options": {
          "test": {},
          "parallel": true,
          "minimizer": {
            "options": {
              "preset": [
                "default",
                {
                  "discardComments": {
                    "removeAll": true
                  }
                }
              ]
            }
          }
        }
      }
    ],
    "runtimeChunk": "single",
    "splitChunks": {
      "cacheGroups": {
        "bud": {
          "chunks": "all",
          "test": {},
          "reuseExistingChunk": true,
          "priority": -10
        },
        "vendor": {
          "chunks": "all",
          "test": {},
          "reuseExistingChunk": true,
          "priority": -20
        }
      }
    }
  },
  "parallelism": 7,
  "performance": {
    "hints": false
  },
  "recordsPath": "/Users/minemindmedia/Development/trellis.clients.clearcom.build/site/web/app/themes/clearcomcrm/.budfiles/bud/modules.json",
  "stats": {
    "preset": "normal"
  },
  "target": "browserslist:/Users/minemindmedia/Development/trellis.clients.clearcom.build/site/web/app/themes/clearcomcrm/package.json",
  "plugins": [
    {
      "patterns": [
        {
          "from": "images/**/*",
          "context": "/Users/minemindmedia/Development/trellis.clients.clearcom.build/site/web/app/themes/clearcomcrm/resources",
          "noErrorOnMissing": true
        }
      ],
      "options": {}
    },
    {
      "options": {
        "assetHookStage": null,
        "basePath": "",
        "fileName": "manifest.json",
        "filter": null,
        "map": null,
        "publicPath": "",
        "removeKeyHash": {},
        "sort": null,
        "transformExtensions": {},
        "useEntryKeys": false,
        "useLegacyEmit": false,
        "writeToFileEmit": true
      }
    },
    {
      "_sortedModulesCache": {},
      "options": {
        "filename": "[name].[contenthash:6].css",
        "ignoreOrder": false,
        "runtime": true,
        "chunkFilename": "[name].[contenthash:6].css"
      },
      "runtimeOptions": {
        "linkType": "text/css"
      }
    },
    {
      "options": {
        "emitHtml": false
      },
      "plugin": {
        "name": "EntrypointsManifestPlugin",
        "stage": null
      },
      "name": "entrypoints.json"
    },
    {
      "name": "WordPressExternalsWebpackPlugin",
      "stage": null,
      "externals": {
        "type": "window"
      }
    },
    {
      "plugin": {
        "name": "WordPressDependenciesWebpackPlugin",
        "stage": null
      },
      "manifest": {},
      "usedDependencies": {},
      "fileName": "wordpress.json"
    },
    {
      "plugin": {
        "name": "MergedManifestPlugin"
      },
      "file": "entrypoints.json",
      "entrypointsName": "entrypoints.json",
      "wordpressName": "wordpress.json"
    }
  ],
  "entry": {
    "app": {
      "import": [
        "@scripts/app",
        "@styles/app"
      ]
    },
    "editor": {
      "import": [
        "@scripts/editor",
        "@styles/editor"
      ]
    }
  },
  "resolve": {
    "alias": {
      "@src": "/Users/minemindmedia/Development/trellis.clients.clearcom.build/site/web/app/themes/clearcomcrm/resources",
      "@dist": "/Users/minemindmedia/Development/trellis.clients.clearcom.build/site/web/app/themes/clearcomcrm/public",
      "@fonts": "/Users/minemindmedia/Development/trellis.clients.clearcom.build/site/web/app/themes/clearcomcrm/resources/fonts",
      "@images": "/Users/minemindmedia/Development/trellis.clients.clearcom.build/site/web/app/themes/clearcomcrm/resources/images",
      "@scripts": "/Users/minemindmedia/Development/trellis.clients.clearcom.build/site/web/app/themes/clearcomcrm/resources/scripts",
      "@styles": "/Users/minemindmedia/Development/trellis.clients.clearcom.build/site/web/app/themes/clearcomcrm/resources/styles"
    },
    "extensions": [
      ".wasm",
      ".mjs",
      ".js",
      ".jsx",
      ".css",
      ".json",
      ".toml",
      ".yml"
    ],
    "modules": [
      "/Users/minemindmedia/Development/trellis.clients.clearcom.build/site/web/app/themes/clearcomcrm/resources",
      "node_modules"
    ]
  }
}