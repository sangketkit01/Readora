@extends('user.layout')
@section('title', 'Home')
@push('style')
    <link rel="stylesheet" href="/css/user/rec.css">
@endpush
@section('containerClassName', "indexContainer")

@section('content')
<div class="row">
    <div class="side">
        <p class="_1">1</p>
    </div>
    <div class="container">
        <h1>ยอดนิยม</h1>
        <a class="btn" id="btn2" href="{{ url('user/rec1') }}" target="_self" role="button">novel</a>
        <a class="btn" id="btn1" href="#" target="_self" role="button">commic</a>
        <div class="recommend-section1">
            <div class="recommend-card">
                <div class="row g-0">
                    <div class="col-md-4">
                        <img src="https://images.unsplash.com/photo-1511988617509-a57c8a288659?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60"
                            class="img-fluid rounded-start" alt="...">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title">title</h5>
                            <p class="card-text">title</p>
                            <p class="card-text"><small class="text-body-secondary">title</small></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="recommend-card">
                <div class="row g-0">
                    <div class="col-md-4">
                        <img src="https://images.unsplash.com/photo-1511988617509-a57c8a288659?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60"
                            class="img-fluid rounded-start" alt="...">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title">Card title</h5>
                            <p class="card-text">This is a wider card with supporting text below as a natural
                                lead-in to
                                additional
                                content. This content is a little bit longer.</p>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="recommend-card">
                <div class="row g-0">
                    <div class="col-md-4">
                        <img src="https://images.unsplash.com/photo-1511988617509-a57c8a288659?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60"
                            class="img-fluid rounded-start" alt="...">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title">Card title</h5>
                            <p class="card-text">This is a wider card with supporting text below as a natural
                                lead-in to
                                additional
                                content. This content is a little bit longer.</p>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="recommend-card">
                <div class="row g-0">
                    <div class="col-md-4">
                        <img src="https://images.unsplash.com/photo-1511988617509-a57c8a288659?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60"
                            class="img-fluid rounded-start" alt="...">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title">Card title</h5>
                            <p class="card-text">This is a wider card with supporting text below as a natural
                                lead-in to
                                additional
                                content. This content is a little bit longer.</p>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="recommend-card">
                <div class="row g-0">
                    <div class="col-md-4">
                        <img src="https://images.unsplash.com/photo-1511988617509-a57c8a288659?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60"
                            class="img-fluid rounded-start" alt="...">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title">Card title</h5>
                            <p class="card-text">This is a wider card with supporting text below as a natural
                                lead-in to
                                additional
                                content. This content is a little bit longer.</p>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="recommend-card">
                <div class="row g-0">
                    <div class="col-md-4">
                        <img src="https://images.unsplash.com/photo-1511988617509-a57c8a288659?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60"
                            class="img-fluid rounded-start" alt="...">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title">Card title</h5>
                            <p class="card-text">This is a wider card with supporting text below as a natural
                                lead-in to
                                additional
                                content. This content is a little bit longer.</p>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="recommend-card">
                <div class="row g-0">
                    <div class="col-md-4">
                        <img src="https://images.unsplash.com/photo-1511988617509-a57c8a288659?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60"
                            class="img-fluid rounded-start" alt="...">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title">Card title</h5>
                            <p class="card-text">This is a wider card with supporting text below as a natural
                                lead-in to
                                additional
                                content. This content is a little bit longer.</p>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="recommend-card">
                <div class="row g-0">
                    <div class="col-md-4">
                        <img src="https://images.unsplash.com/photo-1511988617509-a57c8a288659?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60"
                            class="img-fluid rounded-start" alt="...">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title">Card title</h5>
                            <p class="card-text">This is a wider card with supporting text below as a natural
                                lead-in to
                                additional
                                content. This content is a little bit longer.</p>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="recommend-card">
                <div class="row g-0">
                    <div class="col-md-4">
                        <img src="https://images.unsplash.com/photo-1511988617509-a57c8a288659?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60"
                            class="img-fluid rounded-start" alt="...">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title">Card title</h5>
                            <p class="card-text">This is a wider card with supporting text below as a natural
                                lead-in to
                                additional
                                content. This content is a little bit longer.</p>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="recommend-card">
                <div class="row g-0">
                    <div class="col-md-4">
                        <img src="https://images.unsplash.com/photo-1511988617509-a57c8a288659?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60"
                            class="img-fluid rounded-start" alt="...">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title">Card title</h5>
                            <p class="card-text">This is a wider card with supporting text below as a natural
                                lead-in to
                                additional
                                content. This content is a little bit longer.</p>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="recommend-card">
                <div class="row g-0">
                    <div class="col-md-4">
                        <img src="https://images.unsplash.com/photo-1511988617509-a57c8a288659?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60"
                            class="img-fluid rounded-start" alt="...">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title">Card title</h5>
                            <p class="card-text">This is a wider card with supporting text below as a natural
                                lead-in to
                                additional
                                content. This content is a little bit longer.</p>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="recommend-card">
                <div class="row g-0">
                    <div class="col-md-4">
                        <img src="https://images.unsplash.com/photo-1511988617509-a57c8a288659?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60"
                            class="img-fluid rounded-start" alt="...">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title">Card title</h5>
                            <p class="card-text">This is a wider card with supporting text below as a natural
                                lead-in to
                                additional
                                content. This content is a little bit longer.</p>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="recommend-card">
                <div class="row g-0">
                    <div class="col-md-4">
                        <img src="https://images.unsplash.com/photo-1511988617509-a57c8a288659?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60"
                            class="img-fluid rounded-start" alt="...">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title">Card title</h5>
                            <p class="card-text">This is a wider card with supporting text below as a natural
                                lead-in to
                                additional
                                content. This content is a little bit longer.</p>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="recommend-card">
                <div class="row g-0">
                    <div class="col-md-4">
                        <img src="https://images.unsplash.com/photo-1511988617509-a57c8a288659?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60"
                            class="img-fluid rounded-start" alt="...">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title">Card title</h5>
                            <p class="card-text">This is a wider card with supporting text below as a natural
                                lead-in to
                                additional
                                content. This content is a little bit longer.</p>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="side">

    </div>
    @endsection