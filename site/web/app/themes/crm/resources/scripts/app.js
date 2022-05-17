import {domReady} from '@roots/sage/client';
import Alpine from 'alpinejs';
/**
 * app.main
 */
const main = async (err) => {
  if (err) {
    // handle hmr errors
    console.error(err);
  }

    // Initialize AlpineJS & Extensions
  window.Alpine = Alpine
  Alpine.start()
  acf.do_action('append', $('#editcontact'));

};

/**
 * Initialize
 *
 * @see https://webpack.js.org/api/hot-module-replacement
 */
domReady(main);
import.meta.webpackHot?.accept(main);

var tf = new TableFilter(document.querySelector('.my-table'), {
    base_path: 'path/to/my/scripts/tablefilter/'
});
tf.init();

