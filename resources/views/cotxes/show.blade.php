@extends('layouts.app')

@section('title', '— ' . $cotxe->model)

@section('content')

<style>
    .back-link {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        color: var(--gray-light);
        text-decoration: none;
        font-size: 0.82rem;
        font-family: 'Space Mono', monospace;
        margin-bottom: 1.5rem;
        transition: color 0.15s;
    }
    .back-link:hover { color: var(--white); }

    .cotxe-hero {
        position: relative;
        border: 1px solid var(--border);
        border-radius: 6px;
        overflow: hidden;
        margin-bottom: 1.5rem;
    }

    .cotxe-hero-img {
        width: 100%;
        height: 380px;
        object-fit: cover;
        display: block;
    }

    .cotxe-hero-placeholder {
        width: 100%;
        height: 220px;
        background: #111;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #222;
        font-size: 5rem;
    }

    .cotxe-hero-overlay {
        position: absolute;
        bottom: 0; left: 0; right: 0;
        background: linear-gradient(transparent, rgba(0,0,0,0.9));
        padding: 2rem 1.5rem 1.25rem;
    }

    .cotxe-hero-header {
        display: flex;
        align-items: flex-end;
        justify-content: space-between;
    }

    .cotxe-hero-title {
        font-family: 'Bebas Neue', sans-serif;
        font-size: 3rem;
        letter-spacing: 3px;
        line-height: 1;
    }

    .cotxe-hero-year {
        font-family: 'Space Mono', monospace;
        font-size: 1.1rem;
        color: var(--orange);
        margin-bottom: 4px;
    }

    .cotxe-hero-actions {
        display: flex;
        gap: 8px;
    }

    /* NO IMAGE: inline header */
    .cotxe-header-inline {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        margin-bottom: 1.5rem;
        padding: 1.5rem;
        background: #0f0f0f;
        border: 1px solid var(--border);
        border-radius: 6px;
    }

    .cotxe-meta-block { }

    .cotxe-owner-row {
        display: flex;
        align-items: center;
        gap: 8px;
        margin-top: 10px;
    }

    .cotxe-owner-info { }

    .owner-name {
        font-weight: 600;
        font-size: 0.9rem;
    }

    .owner-date {
        font-size: 0.75rem;
        color: var(--gray-light);
    }

    .cotxe-description {
        color: #aaa;
        font-size: 0.9rem;
        line-height: 1.7;
        margin-top: 8px;
        max-width: 620px;
    }

    /* TWO-COLUMN LAYOUT */
    .detail-layout {
        display: grid;
        grid-template-columns: 1fr 340px;
        gap: 1.5rem;
        align-items: start;
    }

    /* MODS */
    .section-label {
        font-family: 'Bebas Neue', sans-serif;
        font-size: 1.2rem;
        letter-spacing: 2px;
        margin-bottom: 1rem;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .section-label .count {
        font-family: 'Space Mono', monospace;
        font-size: 0.7rem;
        color: var(--gray-light);
        font-weight: 400;
    }

    .mod-list { display: flex; flex-direction: column; gap: 1px; background: var(--border); border: 1px solid var(--border); border-radius: 6px; overflow: hidden; margin-bottom: 1.5rem; }

    .mod-item {
        background: var(--black);
        padding: 1rem 1.25rem;
        display: flex;
        gap: 12px;
        align-items: flex-start;
    }

    .mod-type {
        font-family: 'Space Mono', monospace;
        font-size: 0.65rem;
        color: var(--orange);
        background: rgba(232,82,26,0.08);
        border: 1px solid rgba(232,82,26,0.2);
        padding: 2px 7px;
        border-radius: 2px;
        white-space: nowrap;
        margin-top: 3px;
        flex-shrink: 0;
    }

    .mod-body { flex: 1; }

    .mod-nom {
        font-weight: 600;
        font-size: 0.9rem;
        margin-bottom: 3px;
    }

    .mod-descripcio {
        font-size: 0.82rem;
        color: var(--gray-light);
        line-height: 1.5;
    }

    .mod-actions {
        display: flex;
        gap: 6px;
        flex-shrink: 0;
    }

    /* MOD FORM */
    .add-mod-form {
        background: #0f0f0f;
        border: 1px solid var(--border);
        border-radius: 6px;
        padding: 1.25rem;
        margin-bottom: 1.5rem;
    }

    .add-mod-form .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 10px;
    }

    /* COMMENTS */
    .comment-sidebar {
        position: sticky;
        top: 72px;
    }

    .comment-list { display: flex; flex-direction: column; gap: 1px; background: var(--border); border: 1px solid var(--border); border-radius: 6px; overflow: hidden; margin-bottom: 1rem; }

    .comment-item {
        background: var(--black);
        padding: 1rem 1.1rem;
    }

    .comment-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 6px;
    }

    .comment-user {
        display: flex;
        align-items: center;
        gap: 7px;
    }

    .comment-username {
        font-size: 0.82rem;
        font-weight: 600;
    }

    .comment-date {
        font-size: 0.72rem;
        color: #444;
        font-family: 'Space Mono', monospace;
    }

    .comment-text {
        font-size: 0.85rem;
        color: #bbb;
        line-height: 1.6;
    }

    .comment-form {
        background: #0f0f0f;
        border: 1px solid var(--border);
        border-radius: 6px;
        padding: 1rem;
    }

    .comment-form textarea {
        resize: none;
        height: 80px;
        margin-bottom: 8px;
    }
</style>

<a href="{{ route('cotxes.index') }}" class="back-link">&#8592; tornar al feed</a>

@if($cotxe->imatge_principal)
    <div class="cotxe-hero">
        <img src="{{ $cotxe->imatge_principal }}" alt="{{ $cotxe->model }}" class="cotxe-hero-img">
        <div class="cotxe-hero-overlay">
            <div class="cotxe-hero-header">
                <div>
                    <div class="cotxe-hero-year">{{ $cotxe->any }}</div>
                    <div class="cotxe-hero-title">{{ strtoupper($cotxe->model) }}</div>
                    <div class="cotxe-owner-row" style="margin-top:8px;">
                        <div class="avatar avatar-sm">{{ substr($cotxe->user->name, 0, 2) }}</div>
                        <div>
                            <div class="owner-name">{{ $cotxe->user->name }}</div>
                            <div class="owner-date">{{ $cotxe->created_at->diffForHumans() }}</div>
                        </div>
                    </div>
                </div>
                @auth
                    @if(Auth::id() === $cotxe->user_id || Auth::user()->is_admin)
                        <div class="cotxe-hero-actions">
                            <a href="{{ route('cotxes.edit', $cotxe->id) }}" class="btn btn-ghost btn-sm">Editar</a>
                            <button onclick="openModal('delete-cotxe')" class="btn btn-danger btn-sm">Eliminar</button>
                        </div>
                    @endif
                @endauth
            </div>
        </div>
    </div>
    @if($cotxe->descripcio)
        <p class="cotxe-description" style="margin-bottom:1.5rem;">{{ $cotxe->descripcio }}</p>
    @endif
@else
    <div class="cotxe-header-inline">
        <div class="cotxe-meta-block">
            <div style="font-family:'Space Mono',monospace;font-size:0.75rem;color:var(--orange);margin-bottom:4px;">{{ $cotxe->any }}</div>
            <div style="font-family:'Bebas Neue',sans-serif;font-size:2.5rem;letter-spacing:2px;line-height:1;">{{ strtoupper($cotxe->model) }}</div>
            @if($cotxe->descripcio)
                <p class="cotxe-description">{{ $cotxe->descripcio }}</p>
            @endif
            <div class="cotxe-owner-row">
                <div class="avatar avatar-sm">{{ substr($cotxe->user->name, 0, 2) }}</div>
                <div>
                    <div class="owner-name">{{ $cotxe->user->name }}</div>
                    <div class="owner-date">{{ $cotxe->created_at->diffForHumans() }}</div>
                </div>
            </div>
        </div>
        @auth
            @if(Auth::id() === $cotxe->user_id || Auth::user()->is_admin)
                <div style="display:flex;gap:8px;">
                    <a href="{{ route('cotxes.edit', $cotxe->id) }}" class="btn btn-ghost btn-sm">Editar</a>
                    <button onclick="openModal('delete-cotxe')" class="btn btn-danger btn-sm">Eliminar</button>
                </div>
            @endif
        @endauth
    </div>
@endif

<div class="detail-layout">

    <div>
        <div class="section-label">
            MODIFICACIONS
            <span class="count">{{ $cotxe->mods->count() }} mods</span>
        </div>

        @auth
            @if(Auth::id() === $cotxe->user_id || Auth::user()->is_admin)
                <div class="add-mod-form">
                    <div style="font-size:0.8rem;font-weight:600;letter-spacing:0.8px;text-transform:uppercase;color:var(--gray-light);margin-bottom:1rem;">Nova modificació</div>
                    <form method="POST" action="{{ route('mods.store') }}">
                        @csrf
                        <input type="hidden" name="cotxe_id" value="{{ $cotxe->id }}">
                        <div class="form-row">
                            <div class="form-group">
                                <label>Nom</label>
                                <input type="text" name="nom" placeholder="Ex: Turbo K03" required>
                            </div>
                            <div class="form-group">
                                <label>Tipus</label>
                                <input type="text" name="tipus" placeholder="Ex: Motor, Suspensió...">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Descripció</label>
                            <textarea name="descripcio" rows="2" style="resize:none;" placeholder="Detalls de la modificació..."></textarea>
                        </div>
                        <div class="form-group" style="margin-bottom:0;">
                            <label>Imatge (URL)</label>
                            <input type="url" name="imatge" placeholder="https://...">
                        </div>
                        <div style="margin-top:1rem;text-align:right;">
                            <button type="submit" class="btn btn-primary btn-sm">Afegir mod</button>
                        </div>
                    </form>
                </div>
            @endif
        @endauth

        @if($cotxe->mods->isEmpty())
            <div style="text-align:center;padding:2.5rem;color:#333;font-family:'Space Mono',monospace;font-size:0.75rem;border:1px solid var(--border);border-radius:6px;">
                CAP MODIFICACIÓ REGISTRADA
            </div>
        @else
            <div class="mod-list">
                @foreach($cotxe->mods as $mod)
                    <div class="mod-item">
                        @if($mod->tipus)
                            <div class="mod-type">{{ strtoupper($mod->tipus) }}</div>
                        @endif
                        <div class="mod-body">
                            <div class="mod-nom">{{ $mod->nom }}</div>
                            @if($mod->descripcio)
                                <div class="mod-descripcio">{{ $mod->descripcio }}</div>
                            @endif
                            @if($mod->imatge)
                                <img src="{{ $mod->imatge }}" alt="{{ $mod->nom }}" style="width:100%;max-height:160px;object-fit:cover;border-radius:4px;margin-top:8px;">
                            @endif
                        </div>
                        @auth
                            @if(Auth::id() === $cotxe->user_id || Auth::user()->is_admin)
                                <div class="mod-actions">
                                    <button onclick="openModal('edit-mod-{{ $mod->id }}')" class="btn btn-ghost btn-sm">✎</button>
                                    <form method="POST" action="{{ route('mods.destroy', $mod->id) }}" style="display:inline;">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Eliminar mod?')">✕</button>
                                    </form>
                                </div>
                            @endif
                        @endauth
                    </div>
                @endforeach
            </div>
        @endif
    </div>

    <div class="comment-sidebar">
        <div class="section-label">
            COMENTARIS
            <span class="count">{{ $cotxe->comentaris->count() }}</span>
        </div>

        @auth
            <div class="comment-form" style="margin-bottom:1rem;">
                <form method="POST" action="{{ route('comentaris.store') }}">
                    @csrf
                    <input type="hidden" name="cotxe_id" value="{{ $cotxe->id }}">
                    <textarea name="descripcio" placeholder="Escriu un comentari..." required></textarea>
                    <button type="submit" class="btn btn-primary btn-sm" style="width:100%;">Publicar</button>
                </form>
            </div>
        @else
            <div style="text-align:center;padding:1rem;color:var(--gray-light);font-size:0.82rem;border:1px solid var(--border);border-radius:6px;margin-bottom:1rem;">
                <a href="{{ route('login') }}" style="color:var(--orange);">Inicia sessió</a> per comentar
            </div>
        @endauth

        @if($cotxe->comentaris->isEmpty())
            <div style="text-align:center;padding:2rem;color:#333;font-family:'Space Mono',monospace;font-size:0.72rem;border:1px solid var(--border);border-radius:6px;">
                SENSE COMENTARIS
            </div>
        @else
            <div class="comment-list">
                @foreach($cotxe->comentaris->sortByDesc('created_at') as $comentari)
                    <div class="comment-item">
                        <div class="comment-header">
                            <div class="comment-user">
                                <div class="avatar avatar-sm">{{ substr($comentari->user->name, 0, 2) }}</div>
                                <span class="comment-username">{{ $comentari->user->name }}</span>
                            </div>
                            <span class="comment-date">{{ $comentari->created_at->diffForHumans() }}</span>
                        </div>
                        <div class="comment-text">{{ $comentari->descripcio }}</div>
                        @auth
                            @if(Auth::id() === $comentari->user_id || Auth::user()->is_admin)
                                <div style="display:flex;gap:6px;margin-top:8px;">
                                    <button onclick="openModal('edit-comment-{{ $comentari->id }}')" class="btn btn-ghost btn-sm">editar</button>
                                    <form method="POST" action="{{ route('comentaris.destroy', $comentari->id) }}" style="display:inline;">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">eliminar</button>
                                    </form>
                                </div>
                            @endif
                        @endauth
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>

<div class="modal-overlay" id="delete-cotxe">
    <div class="modal">
        <div class="modal-title">ELIMINAR COTXE</div>
        <p style="color:var(--gray-light);font-size:0.875rem;margin-bottom:1.5rem;">Aquesta acció és irreversible. S'eliminaran totes les modificacions i comentaris associats.</p>
        <div style="display:flex;gap:8px;justify-content:flex-end;">
            <button onclick="closeModal('delete-cotxe')" class="btn btn-ghost">Cancel·lar</button>
            <form method="POST" action="{{ route('cotxes.destroy', $cotxe->id) }}">
                @csrf @method('DELETE')
                <button type="submit" class="btn btn-danger">Eliminar</button>
            </form>
        </div>
    </div>
</div>

@auth
    @foreach($cotxe->comentaris as $comentari)
        @if(Auth::id() === $comentari->user_id || Auth::user()->is_admin)
            <div class="modal-overlay" id="edit-comment-{{ $comentari->id }}">
                <div class="modal">
                    <div class="modal-title">EDITAR COMENTARI</div>
                    <form method="POST" action="{{ route('comentaris.update', $comentari->id) }}">
                        @csrf @method('PUT')
                        <div class="form-group">
                            <label>Comentari</label>
                            <textarea name="descripcio" rows="4" required>{{ $comentari->descripcio }}</textarea>
                        </div>
                        <div style="display:flex;gap:8px;justify-content:flex-end;">
                            <button type="button" onclick="closeModal('edit-comment-{{ $comentari->id }}')" class="btn btn-ghost">Cancel·lar</button>
                            <button type="submit" class="btn btn-primary">Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
        @endif
    @endforeach

    @foreach($cotxe->mods as $mod)
        @if(Auth::id() === $cotxe->user_id || Auth::user()->is_admin)
            <div class="modal-overlay" id="edit-mod-{{ $mod->id }}">
                <div class="modal">
                    <div class="modal-title">EDITAR MOD</div>
                    <form method="POST" action="{{ route('mods.update', $mod->id) }}">
                        @csrf @method('PUT')
                        <div class="form-group">
                            <label>Nom</label>
                            <input type="text" name="nom" value="{{ $mod->nom }}" required>
                        </div>
                        <div class="form-group">
                            <label>Tipus</label>
                            <input type="text" name="tipus" value="{{ $mod->tipus }}">
                        </div>
                        <div class="form-group">
                            <label>Descripció</label>
                            <textarea name="descripcio" rows="3">{{ $mod->descripcio }}</textarea>
                        </div>
                        <div class="form-group">
                            <label>Imatge (URL)</label>
                            <input type="url" name="imatge" value="{{ $mod->imatge }}">
                        </div>
                        <div style="display:flex;gap:8px;justify-content:flex-end;">
                            <button type="button" onclick="closeModal('edit-mod-{{ $mod->id }}')" class="btn btn-ghost">Cancel·lar</button>
                            <button type="submit" class="btn btn-primary">Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
        @endif
    @endforeach
@endauth

@endsection