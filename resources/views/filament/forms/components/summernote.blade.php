<x-dynamic-component
    :component="$getFieldWrapperView()"
    :field="$field"
>
    <div
        wire:ignore
        x-data="{
            state: $wire.$entangle(@js($getStatePath())),
            isUpdating: false,
            init() {
                const checkReady = () => {
                    if (typeof window.jQuery !== 'undefined' && typeof window.jQuery.fn.summernote !== 'undefined') {
                        this.setupEditor();
                    } else {
                        setTimeout(checkReady, 50);
                    }
                };
                checkReady();
            },
            setupEditor() {
                const self = this;
                const $el = window.jQuery(this.$refs.summernote);

                $el.summernote({
                    placeholder: @js($getPlaceholder() ?? 'Ketik konten di sini (bisa sisipkan gambar/tabel)...'),
                    tabsize: 2,
                    height: @js($getHeight() ?? 250),
                    minHeight: @js($getMinHeight() ?? 150),
                    maxHeight: @js($getMaxHeight() ?? null),
                    dialogsInBody: true,
                    dialogsFade: true,
                    toolbar: [
                        ['style', ['style']],
                        ['font', ['bold', 'underline', 'clear']],
                        ['color', ['color']],
                        ['para', ['ul', 'ol', 'paragraph']],
                        ['table', ['table']],
                        ['insert', ['link', 'picture', 'video']],
                        ['view', ['fullscreen', 'codeview', 'help']]
                    ],
                    callbacks: {
                        onChange: function(contents) {
                            self.isUpdating = true;
                            self.state = contents;
                            setTimeout(() => { self.isUpdating = false; }, 30);
                        },
                        onBlur: function() {
                            self.state = $el.summernote('code');
                        },
                        onImageUpload: function(files) {
                            for (let i = 0; i < files.length; i++) {
                                const file = files[i];
                                const reader = new FileReader();
                                reader.onload = function(e) {
                                    $el.summernote('insertImage', e.target.result, file.name);
                                    self.state = $el.summernote('code');
                                };
                                reader.readAsDataURL(file);
                            }
                        }
                    }
                });

                if (this.state) {
                    $el.summernote('code', this.state);
                }

                this.$watch('state', (value) => {
                    if (!self.isUpdating && value !== $el.summernote('code')) {
                        $el.summernote('code', value ?? '');
                    }
                });

                // Pastikan nilai terbaru tersimpan saat form disubmit
                const form = this.$el.closest('form');
                if (form) {
                    form.addEventListener('submit', () => {
                        self.state = $el.summernote('code');
                    });
                }
            }
        }"
        class="summernote-editor-container w-full"
    >
        <textarea x-ref="summernote" id="{{ $getId() }}" style="display: none;"></textarea>
    </div>
</x-dynamic-component>