@extends('layouts.app')

@section('title', '— Feed')

@section('content')

<style>
    .feed-header {
        display: flex;
        align-items: baseline;
        justify-content: space-between;
        margin-bottom: 2rem;
        padding-bottom: 1rem;
        border-bottom: 1px solid var(--border);
    }

    .feed-title {
        font-family: 'Bebas Neue', sans-serif;
        font-size: 2rem;
        letter-spacing: 2px;
    }

    .feed-count {
        font-family: 'Space Mono', monospace;
        font-size: 0.75rem;
        color: var(--gray-light);
    }

    .cotxe-grid {
        display: grid;
        gap: 1px;
        background: var(--border);
    }

    .cotxe-card {
        background: var(--black);
        display: grid;
        grid-template-columns: auto 1fr auto;
        gap: 0;
        transition: background 0.15s;
        text-decoration: none;
        color: inherit;
    }

    .cotxe-card:hover { background: #0f0f0f; }

    .cotxe-number {
        width: 56px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-family: 'Space Mono', monospace;
        font-size: 0.7rem;
        color: #333;
        border-right: 1px solid var(--border);
    }

    .cotxe-main {
        padding: 1.1rem 1.25rem;
    }

    .cotxe-meta {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 6px;
    }

    .cotxe-model {
        font-family: 'Bebas Neue', sans-serif;
        font-size: 1.25rem;
        letter-spacing: 1px;
        color: var(--white);
    }

    .cotxe-any {
        font-family: 'Space Mono', monospace;
        font-size: 0.75rem;
        color: var(--orange);
    }

    .cotxe-desc {
        font-size: 0.85rem;
        color: var(--gray-light);
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        max-width: 500px;
    }

    .cotxe-owner {
        display: flex;
        align-items: center;
        gap: 6px;
        margin-top: 8px;
    }

    .cotxe-owner-name {
        font-size: 0.78rem;
        color: #555;
    }

    .cotxe-stats {
        display: flex;
        flex-direction: column;
        align-items: flex-end;
        justify-content: center;
        padding: 1rem 1.25rem;
        gap: 6px;
        border-left: 1px solid var(--border);
        min-width: 100px;
    }

    .stat-item {
        display: flex;
        align-items: center;
        gap: 5px;
        font-family: 'Space Mono', monospace;
        font-size: 0.7rem;
        color: var(--gray-light);
    }

    .cotxe-img {
        width: 100%;
        height: 180px;
        object-fit: cover;
        display: block;
    }

    .cotxe-img-placeholder {
        width: 100%;
        height: 180px;
        background: #111;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #333;
        font-size: 2.5rem;
    }

    .has-image .cotxe-card {
        grid-template-columns: 1fr;
        display: block;
    }
</style>

<div class="feed-header">
    <h1 class="feed-title">GARAGE FEED</h1>
    <span class="feed-count">{{ $cotxes->count() }} vehicles</span>
</div>

@if($cotxes->isEmpty())
    <div class="empty-state">
        <span class="empty-state-icon">&#9881;</span>
        <h3>El garatge és buit</h3>
        <p style="margin-bottom:1.5rem;">Sigues el primer en afegir el teu cotxe.</p>
        @auth
            <a href="{{ route('cotxes.create') }}" class="btn btn-primary">+ Afegir cotxe</a>
        @endauth
    </div>
@else
    <div class="cotxe-grid">
        @foreach($cotxes as $i => $cotxe)
            <a href="{{ route('cotxes.show', $cotxe->id) }}" class="cotxe-card">
                <div class="cotxe-number">{{ str_pad($i + 1, 2, '0', STR_PAD_LEFT) }}</div>
                <div class="cotxe-main">
                    @if($cotxe->imatge_principal)
                        <img src="{{ $cotxe->imatge_principal }}" alt="{{ $cotxe->model }}" class="cotxe-img" style="margin:-1.1rem -1.25rem 1rem;width:calc(100% + 2.5rem);max-width:none;">
                    @endif
                    <div class="cotxe-meta">
                        <span class="cotxe-model">{{ $cotxe->model }}</span>
                        <span class="cotxe-any">'{{ substr($cotxe->any, -2) }}</span>
                        @if($cotxe->mods_count ?? $cotxe->mods->count())
                            <span class="tag tag-orange">{{ $cotxe->mods->count() }} mods</span>
                        @endif
                    </div>
                    @if($cotxe->descripcio)
                        <div class="cotxe-desc">{{ $cotxe->descripcio }}</div>
                    @endif
                    <div class="cotxe-owner">
                        <div class="avatar avatar-sm">{{ substr($cotxe->user->name, 0, 2) }}</div>
                        <span class="cotxe-owner-name">{{ $cotxe->user->name }}</span>
                        <span class="cotxe-owner-name">·</span>
                        <span class="cotxe-owner-name">{{ $cotxe->created_at->diffForHumans() }}</span>
                    </div>
                </div>
                <div class="cotxe-stats">
                    <div class="stat-item">
                        <span>&#9997;</span>
                        <span>{{ $cotxe->mods->count() }}</span>
                    </div>
                    <div class="stat-item">
                        <span>&#128172;</span>
                        <span>{{ $cotxe->comentaris->count() }}</span>
                    </div>
                </div>
            </a>
        @endforeach
    </div>
@endif

@endsection