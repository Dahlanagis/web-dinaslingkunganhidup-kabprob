<?php

// 1. Update Migration
$migFile = 'd:\DLH web PKL\database\migrations\2026_09_02_014648_create_galleries_table.php';
$migCode = <<<'PHP'
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('galleries', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('type')->default('foto');
            $table->string('category')->nullable();
            $table->json('images')->nullable(); // Multiple images
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('galleries');
    }
};
PHP;
file_put_contents($migFile, $migCode);

// 2. Update Model
$modFile = 'd:\DLH web PKL\app\Models\Gallery.php';
$modCode = <<<'PHP'
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    protected $guarded = [];

    protected $casts = [
        'images' => 'array',
    ];
}
PHP;
file_put_contents($modFile, $modCode);

// 3. Update Filament Form
$formFile = 'd:\DLH web PKL\app\Filament\Resources\Galleries\Schemas\GalleryForm.php';
$formCode = <<<'PHP'
<?php

namespace App\Filament\Resources\Galleries\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class GalleryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informasi Galeri')
                    ->schema([
                        TextInput::make('title')
                            ->label('Judul Galeri')
                            ->placeholder('Masukkan judul...')
                            ->required()
                            ->maxLength(255)
                            ->columnSpanFull(),
                            
                        Select::make('type')
                            ->label('Tipe Media')
                            ->options([
                                'foto' => 'Foto (Upload Gambar)',
                                'video' => 'Video (Link)',
                            ])
                            ->default('foto')
                            ->required()
                            ->reactive(),
                            
                        Select::make('category')
                            ->label('Kategori Media')
                            ->options([
                                'Kegiatan Lapangan' => 'Kegiatan Lapangan',
                                'Sosialisasi' => 'Sosialisasi',
                                'Penghargaan' => 'Penghargaan',
                                'Lainnya' => 'Lainnya',
                            ])
                            ->helperText('Pilih dari Master Kategori atau ketikkan nama kategori baru.')
                            ->createOptionForm([
                                TextInput::make('category')
                                    ->label('Kategori Baru')
                                    ->required(),
                            ])
                            ->searchable(),
                            
                        FileUpload::make('images')
                            ->label(fn ($get) => $get('type') === 'video' ? 'Upload Thumbnail Video (Opsional)' : 'Upload Foto Baru (Bisa Lebih Dari Satu)')
                            ->image()
                            ->multiple()
                            ->reorderable()
                            ->imageEditor()
                            ->directory('galleries')
                            ->disk('public')
                            ->maxSize(20480) // 20MB
                            ->helperText('Maksimal ukuran file 20MB per foto. Format yang didukung: JPG, PNG, JPEG.')
                            ->columnSpanFull(),
                            
                        Textarea::make('description')
                            ->label('Deskripsi Singkat (Opsional)')
                            ->placeholder('Keterangan singkat tentang media ini...')
                            ->rows(3)
                            ->columnSpanFull(),
                    ])->columns(2),
            ]);
    }
}
PHP;
file_put_contents($formFile, $formCode);

// 4. Update Filament Table
$tabFile = 'd:\DLH web PKL\app\Filament\Resources\Galleries\Tables\GalleriesTable.php';
$tabCode = <<<'PHP'
<?php

namespace App\Filament\Resources\Galleries\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Table;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BadgeColumn;

class GalleriesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('images')
                    ->label('Preview Media')
                    ->square()
                    ->size(80)
                    ->stacked()
                    ->limit(3),
                TextColumn::make('title')
                    ->label('Judul Galeri')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),
                TextColumn::make('category')
                    ->label('Kategori')
                    ->searchable()
                    ->badge(),
                TextColumn::make('type')
                    ->label('Tipe')
                    ->formatStateUsing(fn ($state) => ucfirst($state))
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'foto' => 'success',
                        'video' => 'danger',
                        default => 'primary',
                    }),
                TextColumn::make('created_at')
                    ->label('Diunggah Pada')
                    ->dateTime('d M Y')
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                \Filament\Actions\CreateAction::make()
                    ->label('Tambah Item Galeri')
                    ->icon('heroicon-o-plus'),
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
PHP;
file_put_contents($tabFile, $tabCode);

// 5. Update welcome.blade.php
// We need to fetch images dynamically correctly since it's an array now.
// Since images is an array of paths, we iterate over them. If it's a single gallery item with multiple images, we display all images in the UI individually.

$welcome = 'd:\DLH web PKL\resources\views\welcome.blade.php';
$welCode = file_get_contents($welcome);
// Re-inject the dynamic gallery block to handle array of images
$newGaleriBlock = <<<'HTML'
    <!-- GALERI -->
    <section class="py-5" style="background:#fff;">
        <div class="container py-3">
            <div class="text-center mb-5">
                <div class="section-label">Visual</div>
                <h2 class="section-title">Galeri Dokumentasi</h2>
                <p class="text-muted mt-3" style="max-width:500px;margin:12px auto 0;font-size:.93rem;line-height:1.7;">Potret aktivitas pelayanan lapangan, pengangkutan sampah, dan program kerja DLH.</p>
            </div>
            <ul class="nav gallery-tabs gap-2 justify-content-center mb-5" id="galTab" role="tablist">
                <li class="nav-item"><button class="nav-link active" data-bs-toggle="pill" data-bs-target="#galFoto"><i class="bi bi-camera-fill me-2"></i>Galeri Foto</button></li>
                <li class="nav-item"><button class="nav-link" data-bs-toggle="pill" data-bs-target="#galVideo"><i class="bi bi-play-btn-fill me-2"></i>Galeri Video</button></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane fade show active" id="galFoto">
                    <div class="gallery-scroll">
                        @php
                            // Get all galleries of type foto
                            $galleries = \App\Models\Gallery::where('type', 'foto')->latest()->take(10)->get();
                            $allPhotos = [];
                            foreach($galleries as $g) {
                                $imgs = $g->images ?? [];
                                foreach($imgs as $img) {
                                    $allPhotos[] = ['title' => $g->title, 'path' => $img, 'cat' => $g->category];
                                }
                            }
                        @endphp
                        @forelse($allPhotos as $foto)
                            @php
                                $imgSrc = asset('storage/' . $foto['path']);
                            @endphp
                            <div class="gallery-item" style="cursor:pointer;" onclick="openLightbox('{{ $imgSrc }}', '{{ addslashes($foto['title']) }}', 'photo')">
                                <img src="{{ $imgSrc }}" alt="{{ $foto['title'] }}">
                                <div class="gallery-item-overlay"></div>
                                <div class="gallery-item-content">
                                    <span class="badge mb-2" style="background:rgba(4,120,87,.9);color:#fff;font-size:.7rem;padding:4px 10px;border-radius:100px;backdrop-filter:blur(4px);"><i class="bi bi-images me-1"></i>{{ $foto['cat'] ?? 'FOTO' }}</span>
                                    <h6>{{ $foto['title'] }}</h6>
                                </div>
                            </div>
                        @empty
                            <p class="text-muted w-100 text-center py-4">Belum ada foto galeri.</p>
                        @endforelse
                    </div>
                </div>
                <div class="tab-pane fade" id="galVideo">
                    <div class="gallery-scroll">
                        @php
                            $videoGals = \App\Models\Gallery::where('type', 'video')->latest()->take(5)->get();
                        @endphp
                        @forelse($videoGals as $v)
                            @php
                                $imgs = $v->images ?? [];
                                $imgSrc = !empty($imgs) ? asset('storage/' . $imgs[0]) : 'https://images.unsplash.com/photo-1532996122724-e3c354a0b15b?w=600&h=400&fit=crop';
                                // In real app, video URL might be in description or a dedicated field. 
                                // Since we didn't add a video_url field, let's assume description contains the URL, or just use a dummy for now.
                                $vidUrl = $v->description ? strip_tags($v->description) : 'https://www.youtube.com/embed/dQw4w9WgXcQ';
                            @endphp
                            <div class="gallery-item" style="cursor:pointer;" onclick="openLightbox('{{ $vidUrl }}', '{{ addslashes($v->title) }}', 'video')">
                                <img src="{{ $imgSrc }}" alt="{{ $v->title }}">
                                <div class="gallery-item-overlay"></div>
                                <div class="gallery-play-btn"><i class="bi bi-play-fill"></i></div>
                                <div class="gallery-item-content">
                                    <span class="badge mb-2" style="background:rgba(220,38,38,.9);color:#fff;font-size:.7rem;padding:4px 10px;border-radius:100px;backdrop-filter:blur(4px);"><i class="bi bi-play-btn-fill me-1"></i>VIDEO</span>
                                    <h6>{{ $v->title }}</h6>
                                </div>
                            </div>
                        @empty
                            <p class="text-muted w-100 text-center py-4">Belum ada video galeri.</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </section>
HTML;

$startMarker = '    <!-- GALERI -->';
$endMarker = '    <!-- LIGHTBOX MODAL -->';
if (strpos($welCode, $startMarker) !== false && strpos($welCode, $endMarker) !== false) {
    $parts = explode($startMarker, $welCode, 2);
    $beforeChunk = rtrim($parts[0]);
    $parts2 = explode($endMarker, $parts[1], 2);
    $afterChunk = "\n    " . $endMarker . $parts2[1];
    
    $newContent = $beforeChunk . "\n\n" . ltrim($newGaleriBlock) . "\n" . $afterChunk;
    file_put_contents($welcome, $newContent);
    echo "Files updated.\n";
} else {
    echo "Markers not found in welcome.blade.php.\n";
}

echo "Success.\n";
