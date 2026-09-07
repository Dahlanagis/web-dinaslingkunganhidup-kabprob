<?php

namespace App\Filament\Forms\Components;

use Closure;
use Filament\Forms\Components\Field;

class Summernote extends Field
{
    protected string $view = 'filament.forms.components.summernote';

    protected int | Closure | null $height = 250;

    protected int | Closure | null $minHeight = 150;

    protected int | Closure | null $maxHeight = null;

    protected string | Closure | null $placeholder = 'Ketik konten di sini (bisa sisipkan gambar/tabel)...';

    public function height(int | Closure | null $height): static
    {
        $this->height = $height;

        return $this;
    }

    public function minHeight(int | Closure | null $minHeight): static
    {
        $this->minHeight = $minHeight;

        return $this;
    }

    public function maxHeight(int | Closure | null $maxHeight): static
    {
        $this->maxHeight = $maxHeight;

        return $this;
    }

    public function placeholder(string | Closure | null $placeholder): static
    {
        $this->placeholder = $placeholder;

        return $this;
    }

    public function getHeight(): ?int
    {
        return $this->evaluate($this->height);
    }

    public function getMinHeight(): ?int
    {
        return $this->evaluate($this->minHeight);
    }

    public function getMaxHeight(): ?int
    {
        return $this->evaluate($this->maxHeight);
    }

    public function getPlaceholder(): ?string
    {
        return $this->evaluate($this->placeholder);
    }
}
