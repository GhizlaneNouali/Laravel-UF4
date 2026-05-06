@extends('layouts.app')

@section('title', '— Nou Cotxe')

@section('content')

<style>
    .form-page {
        max-width: 560px;
        margin: 0 auto;
    }

    .form-page-title {
        font-family: 'Bebas Neue', sans-serif;
        font-size: 2rem;
        letter-spacing: 2px;
        margin-bottom: 1.75rem;
        padding-bottom: 1rem;
        border-bottom: 1px solid var(--border);
    }

    .form-card {
        background: #0f0f0f;
        border: 1px solid var(--border);
        border-radius: 6px;
        padding: 1.75rem;
    }

    .form-row-2 {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1rem;
    }

    .form-actions {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding-top: 1.25rem;
        border-top: 1px solid var(--border);
        margin-top: 1.5rem;
    }

    .preview-img {
        width: 100%;
        height: 180px;
        object-fit: cover;
        border-radius: 4px;
        margin-top: 8px;
        border: 1px solid var(--border);
        display: none;
    }
</style>

<div class="form-page">
    <h1 class="form-page-title">NOU COTXE</h1>

    <div class="form-card">
        <form method="POST" action="{{ route('cotxes.store') }}">
            @csrf

            <div class="form-row-2">
                <div class="form-group">
                    <label>Model *</label>
                    <input type="text" name="model" value="{{ old('model') }}" placeholder="Ex: Golf GTI, Civic Type R..." required autofocus>
                    @error('model') <div class="form-error">{{ $message }}</div> @enderror
                </div>
                <div class="form-group">
                    <label>Any *</label>
                    <input type="number" name="any" value="{{ old('any') }}" placeholder="{{ date('Y') }}" min="1900" max="{{ date('Y') + 1 }}" required>
                    @error('any') <div class="form-error">{{ $message }}</div> @enderror
                </div>
            </div>

            <div class="form-group">
                <label>Descripció</label>
                <textarea name="descripcio" rows="3" placeholder="Explica el teu cotxe, la seva història, el projecte...">{{ old('descripcio') }}</textarea>
            </div>

            <div class="form-group" style="margin-bottom:0;">
                <label>Imatge principal (URL)</label>
                <input type="url" name="imatge_principal" value="{{ old('imatge_principal') }}" placeholder="https://..." id="img-url-input">
                <img id="img-preview" class="preview-img" alt="Preview">
            </div>

            <div class="form-actions">
                <a href="{{ route('cotxes.index') }}" class="btn btn-ghost">Cancel·lar</a>
                <button type="submit" class="btn btn-primary">Publicar cotxe</button>
            </div>
        </form>
    </div>
</div>

<script>
    const input = document.getElementById('img-url-input');
    const preview = document.getElementById('img-preview');

    function updatePreview() {
        const url = input.value.trim();
        if (url) {
            preview.src = url;
            preview.style.display = 'block';
            preview.onerror = () => preview.style.display = 'none';
        } else {
            preview.style.display = 'none';
        }
    }

    input.addEventListener('input', updatePreview);
    updatePreview();
</script>

@endsection