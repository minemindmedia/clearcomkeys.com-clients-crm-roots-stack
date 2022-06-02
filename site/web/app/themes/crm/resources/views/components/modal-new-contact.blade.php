<div x-data="{ open: false }" class="relative z-50" id="editcontact">
    
    <span x-on:click="open = true">
        <button type="button" class="inline-flex items-center justify-center px-4 py-2 text-sm font-medium text-white bg-indigo-600 border border-transparent rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:w-auto">
            Add contact
        </button>
    </span>
    
    <div
        x-show="open"
        style="display: none"
        x-on:keydown.escape.prevent.stop="open = false"
        role="dialog"
        aria-modal="true"
        x-id="['modal-title']"
        :aria-labelledby="$id('modal-title')"
        class="fixed inset-0 z-10 overflow-y-auto"
    >
        
        <div x-show="open" x-transition.opacity class="fixed inset-0 bg-black bg-opacity-50"></div>

        
        <div
            x-show="open" x-transition
            x-on:click="open = false"
            class="relative flex items-center justify-center min-h-screen p-4"
        >
            <div
                x-on:click.stop
                x-trap.noscroll.inert="open"
                class="relative w-full max-w-[75%] p-12 overflow-y-auto bg-white shadow-lg rounded-xl"
            >
                <div class="flex">
                  <div class="flex-1">
                    <h2 class="text-3xl font-bold" :id="$id('modal-title')">Add Contact</h2>
                  </div>
                  <div>
                    <button type="button" x-on:click="open = false" class="bg-white border border-gray-200 px-5 py-2.5 rounded-md">
                        Cancel
                    </button>
                  </div>
                </div>
              
                <?php acf_form(array(
                    'post_id'       => 'new_post',
                    'id' => 'new-contact',
                    'new_post'      => array(
                        'post_type'     => 'contacts',
                        'post_status'   => 'publish',
                        'post_title'    => true
                    ),
                    'return' => '%post_url%',
                    'submit_value'  => 'Add new contact'
                )); ?>
              
            </div>
        </div>
    </div>
</div>