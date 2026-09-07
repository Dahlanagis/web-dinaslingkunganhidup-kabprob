<x-dynamic-component
    :component="$getFieldWrapperView()"
    :field="$field"
>
    @php
        $statePath = $field->getStatePath();
        $isMultiple = method_exists($field, 'isMultiple') ? $field->isMultiple() : false;
        $acceptedTypes = method_exists($field, 'getAcceptedFileTypes') ? $field->getAcceptedFileTypes() : null;
        $acceptAttr = $acceptedTypes ? implode(',', $acceptedTypes) : ($field->getName() === 'file_path' ? '.pdf,.doc,.docx,application/pdf' : 'image/jpeg,image/png,image/jpg');
        $helperText = method_exists($field, 'getHelperText') ? $field->getHelperText() : null;
        if (!$helperText) {
            $helperText = $isMultiple 
                ? 'Maksimal ukuran file 20MB per foto. Format yang didukung: JPG, PNG, JPEG.' 
                : 'Format yang didukung: JPG, PNG, JPEG. Ukuran maksimal 5MB.';
        }
    @endphp

    <div
        x-data="{
            state: $wire.$entangle(@js($statePath)),
            isUploading: false,
            uploadProgress: 0,
            previews: [],
            init() {
                this.loadExistingPreviews();
                this.$watch('state', () => {
                    this.loadExistingPreviews();
                });
            },
            loadExistingPreviews() {
                if (!this.state) {
                    this.previews = [];
                    return;
                }
                const files = Array.isArray(this.state) ? this.state : (typeof this.state === 'object' ? Object.values(this.state) : [this.state]);
                this.previews = files.filter(f => typeof f === 'string' && f.trim() !== '').map(f => ({
                    url: f.startsWith('http') || f.startsWith('data:') ? f : '/storage/' + f,
                    name: f.split('/').pop(),
                    isExisting: true,
                    raw: f
                }));
            },
            handleFiles(e) {
                const inputFiles = Array.from(e.target.files);
                if (!inputFiles.length) return;

                const self = this;
                self.isUploading = true;
                self.uploadProgress = 0;

                @if($isMultiple)
                    $wire.uploadMultiple(
                        @js($statePath),
                        inputFiles,
                        (uploadedFileNames) => {
                            self.isUploading = false;
                            self.uploadProgress = 100;
                            inputFiles.forEach(file => {
                                const reader = new FileReader();
                                reader.onload = (re) => {
                                    self.previews.push({
                                        url: re.target.result,
                                        name: file.name,
                                        isExisting: false
                                    });
                                };
                                reader.readAsDataURL(file);
                            });
                        },
                        (error) => {
                            self.isUploading = false;
                            alert('Gagal mengunggah berkas: ' + error);
                        },
                        (event) => {
                            self.uploadProgress = event.detail.progress;
                        }
                    );
                @else
                    $wire.upload(
                        @js($statePath),
                        inputFiles[0],
                        (uploadedFileName) => {
                            self.isUploading = false;
                            self.uploadProgress = 100;
                            const reader = new FileReader();
                            reader.onload = (re) => {
                                self.previews = [{
                                    url: re.target.result,
                                    name: inputFiles[0].name,
                                    isExisting: false
                                }];
                            };
                            reader.readAsDataURL(inputFiles[0]);
                        },
                        (error) => {
                            self.isUploading = false;
                            alert('Gagal mengunggah berkas: ' + error);
                        },
                        (event) => {
                            self.uploadProgress = event.detail.progress;
                        }
                    );
                @endif
            },
            removePreview(index) {
                this.previews.splice(index, 1);

                if (Array.isArray(this.state)) {
                    this.state.splice(index, 1);
                } else if (typeof this.state === 'object' && this.state !== null) {
                    const keys = Object.keys(this.state);
                    if (keys[index]) {
                        delete this.state[keys[index]];
                    }
                } else {
                    this.state = null;
                }
            }
        }"
        class="w-full"
    >
        <div class="native-file-upload-box" style="border: 1.5px dashed #cbd5e1; border-radius: 12px; background-color: #f8fafc; padding: 18px 22px; transition: all 0.2s ease;">
            <input
                type="file"
                x-ref="fileInput"
                @change="handleFiles($event)"
                @if($isMultiple) multiple @endif
                accept="{{ $acceptAttr }}"
                class="native-file-input-control"
                style="display: block; width: 100%; background: #ffffff; border: 1px solid #e2e8f0; border-radius: 8px; padding: 5px 6px; font-size: 14px; color: #334155; box-sizing: border-box; cursor: pointer; outline: none;"
            />

            <p class="native-file-helper-text" style="margin-top: 10px; margin-bottom: 0; font-size: 0.85rem; color: #64748b; font-weight: 500; line-height: 1.5;">
                {{ $helperText }}
            </p>

            <!-- Loading / Upload Progress -->
            <div x-show="isUploading" style="margin-top: 12px;" x-cloak>
                <div style="background-color: #e2e8f0; border-radius: 9999px; height: 6px; overflow: hidden; width: 100%;">
                    <div style="background-color: #166534; height: 6px; border-radius: 9999px; transition: width 0.2s ease;" :style="`width: ${uploadProgress}%`"></div>
                </div>
                <p style="font-size: 0.75rem; color: #166534; font-weight: 600; margin-top: 4px; margin-bottom: 0;">
                    Mengunggah berkas... <span x-text="`${uploadProgress}%`"></span>
                </p>
            </div>

            <!-- Preview Daftar Foto / Berkas -->
            <template x-if="previews.length > 0">
                <div style="margin-top: 16px; padding-top: 14px; border-top: 1px solid #e2e8f0;">
                    <p style="font-size: 0.78rem; font-weight: 700; color: #475569; text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 10px;">
                        Berkas Terpilih (<span x-text="previews.length"></span>):
                    </p>
                    <div style="display: flex; flex-wrap: wrap; gap: 12px;">
                        <template x-for="(item, idx) in previews" :key="idx">
                            <div style="position: relative; width: 90px; height: 90px; border-radius: 8px; overflow: hidden; border: 1px solid #cbd5e1; background: #ffffff; box-shadow: 0 1px 3px rgba(0,0,0,0.08); flex-shrink: 0; display: flex; align-items: center; justify-content: center;">
                                <template x-if="item.url.match(/\.(jpeg|jpg|png|gif|webp|svg)/i) || item.url.startsWith('data:image')">
                                    <img :src="item.url" :alt="item.name" style="width: 100%; height: 100%; object-fit: cover;" />
                                </template>
                                <template x-if="!item.url.match(/\.(jpeg|jpg|png|gif|webp|svg)/i) && !item.url.startsWith('data:image')">
                                    <div style="text-align: center; padding: 4px; font-size: 10px; color: #475569; word-break: break-all;">
                                        📄 <span x-text="item.name.substring(0, 15)"></span>
                                    </div>
                                </template>
                                <button
                                    type="button"
                                    @click.prevent="removePreview(idx)"
                                    style="position: absolute; top: 4px; right: 4px; background: rgba(220, 38, 38, 0.85); color: #ffffff; border: none; border-radius: 9999px; width: 20px; height: 20px; font-size: 11px; font-weight: bold; display: flex; align-items: center; justify-content: center; cursor: pointer; transition: background 0.15s ease;"
                                    title="Hapus berkas ini"
                                    onmouseover="this.style.background='rgba(220, 38, 38, 1)'"
                                    onmouseout="this.style.background='rgba(220, 38, 38, 0.85)'"
                                >
                                    ✕
                                </button>
                            </div>
                        </template>
                    </div>
                </div>
            </template>
        </div>
    </div>
</x-dynamic-component>
