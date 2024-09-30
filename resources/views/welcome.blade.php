@extends('layouts.app')

@section('content')
    <div class="container position-sticky z-index-sticky top-0">
        <div class="row">
            <div class="col-12">
                @include('layouts.navbars.guest.navbar')
            </div>
        </div>
    </div>
    <main class="main-content min-vh-100 d-flex flex-column justify-content-between">
        <section>
            <div class="page-header min-vh-100 d-flex align-items-center justify-content-center" 
                 style="background-image: url('https://raw.githubusercontent.com/creativetimofficial/public-assets/master/argon-dashboard-pro/assets/img/signin-ill.jpg'); 
                        background-size: cover; 
                        background-position: center; 
                        overflow: hidden;">
                <div class="container d-flex justify-content-center align-items-center h-100">
                    <div class="row">
                        <div class="col-lg-8 col-md-10 mx-auto">
                            <div class="bg-white p-5 border rounded shadow-lg text-center" 
                                 style="background-color: rgba(255, 255, 255, 0.85);">
                                <h4 class="text-primary font-weight-bolder mb-4">"Attention is the new currency"</h4>
                                <p class="text-dark mb-0">The more effortless the writing looks, the more effort the writer actually put into the process.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Footer -->
        <footer class="footer mt-auto py-3 bg-light">
            <div class="container text-center">
                <span class="text-muted">© {{ date('Y') }} Your Company. All rights reserved.</span>
            </div>
        </footer>
    </main>
@endsection
