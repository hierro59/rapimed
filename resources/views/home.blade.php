@extends('layouts.app')
@section('content')
@include('layouts.dashboard.forms')
<div class="content-body">
    <div class="container-fluid">
        <div class="form-head d-flex align-items-center mb-sm-4 mb-3">
            <div class="mr-auto">
                <h2 class="text-black font-w600">RapiMed</h2>
                <p class="mb-0">Dashboard</p>
            </div>
           
        </div>


        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="row">
            <div class="col-xl-3 col-sm-6">
                <div class="card">
                    <a href="{{ route('citas.index') }}" style="text-decoration: none; display: flex; color: #111;">
                    <div class="card-body">
                        <div class="media align-items-center">
                            <div class="media-body mr-3">
                                <h2 class="fs-34 text-black font-w600">Citas</h2>
                                <span>Mis citas</span>
                            </div>
                            <i class="flaticon-381-notepad" style="font-size: 2rem; color: #555"></i>
                        </div>
                    </div>
                    </a>
                </div>
            </div>

            @can('customer-view')
            <div class="col-xl-3 col-sm-6">
                <div class="card">
                    <a href="javascript:void(0)" style="text-decoration: none; display: flex; color: #111;" data-toggle="modal" data-target="#addOrderModal">
                    <div class="card-body">
                        <div class="media align-items-center">
                            <div class="media-body mr-3">
                                <h2 class="fs-22 text-black font-w600">Nueva Cita</h2>
                            </div>
                            <i class="flaticon-381-calendar-7" style="font-size: 2rem; color: #555"></i>
                        </div>
                    </div>
                    </a>
                </div>
            </div>
            {{-- <div class="col-xl-3 col-sm-6">
                <div class="card">
                    <a href="{{ route('specialist.show', Auth::user()->id) }}" style="text-decoration: none; display: flex; color: #111;">
                    <div class="card-body">
                        <div class="media align-items-center">
                            <div class="media-body mr-3">
                                <h2 class="fs-34 text-black font-w600">Mis</h2>
                                <span class="fs-18">Especialistas</span>
                            </div>
                            <i class="flaticon-381-heart" style="font-size: 2rem; color: #555"></i>
                        </div>
                    </div>
                    </a>
                </div>
            </div> --}}
            @endcan
            <div class="col-xl-3 col-sm-6">
                <div class="card">
                    <a href="{{ route('users.show', Auth::user()->id) }}" style="text-decoration: none; display: flex; color: #111;">
                    <div class="card-body">
                        <div class="media align-items-center">
                            <div class="media-body mr-3">
                                <h2 class="fs-34 text-black font-w600">Perfil</h2>
                                <span>Mi perfil</span>
                            </div>
                            <i class="flaticon-381-user-7" style="font-size: 2rem; color: #555"></i>
                        </div>
                    </div>
                    </a>
                </div>
            </div>
        @can('super-admin')
            <div class="col-xl-3  col-sm-6">
                <div class="card">
                    <div class="card-body">
                        <div class="media align-items-center">
                            <div class="media-body mr-3">
                                <h2 class="fs-34 text-black font-w600">124,551</h2>
                                <span>Total Pacientes</span>
                            </div>
                            <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M28.0053 2.00495C25.0652 1.92104 22.2028 2.90688 20.0059 4.76001C17.8089 2.90688 14.9465 1.92104 12.0064 2.00495C10.2879 1.99938 8.58941 2.3549 7.03328 3.04589C5.47716 3.73689 4.10208 4.74618 3.00704 6.00112C1.10117 8.19152 -0.89469 12.1574 0.427219 18.6225C2.53907 28.9417 18.358 37.4115 19.0259 37.7601C19.3237 37.9174 19.659 38 19.9999 38C20.3408 38 20.676 37.9174 20.9738 37.7601C21.6478 37.4058 37.4667 28.936 39.5725 18.6225C40.8944 12.1574 38.9006 8.201 36.9947 6.00112C35.9009 4.74722 34.5275 3.73852 32.9732 3.04756C31.4188 2.35659 29.7222 2.00052 28.0053 2.00495ZM35.6608 17.9006C34.1709 25.1899 23.3456 31.9715 20.0099 33.908C16.6741 31.9715 5.84885 25.1918 4.35895 17.9006C3.33302 12.8869 4.73692 9.97454 6.09683 8.41322C6.81663 7.59033 7.71988 6.92874 8.74167 6.47597C9.76346 6.0232 10.8784 5.79049 12.0064 5.79458C13.2101 5.70905 14.4167 5.9205 15.5084 6.40832C16.6002 6.89614 17.5399 7.64369 18.236 8.57806C18.4065 8.87653 18.6585 9.12614 18.9656 9.3008C19.2727 9.47546 19.6237 9.56876 19.9819 9.57095H20.0059C20.3619 9.56861 20.7109 9.47734 21.0178 9.30634C21.3247 9.13534 21.5786 8.89067 21.7537 8.59701C22.4489 7.65541 23.391 6.90174 24.4873 6.4103C25.5836 5.91887 26.7961 5.70665 28.0053 5.79458C29.1347 5.78937 30.2512 6.02153 31.2744 6.47434C32.2977 6.92716 33.2022 7.58934 33.9229 8.41322C35.2788 9.97454 36.6827 12.8869 35.6568 17.9006H35.6608Z" fill="#007A64"/>
                            </svg>
                        </div>
                    </div>
                    <div class="progress  rounded-0" style="height:4px;">
                        <div class="progress-bar rounded-0 bg-secondary progress-animated" style="width: 90%; height:4px;" role="progressbar">
                            <span class="sr-only">90% Complete</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3  col-sm-6">
                <div class="card">
                    <div class="card-body">
                        <div class="media align-items-center">
                            <div class="media-body mr-3">
                                <h2 class="fs-34 text-black font-w600">442</h2>
                                <span>Total Especialistas</span>
                            </div>
                            <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M38.3334 16.6667C38.3384 15.7489 38.0907 14.8474 37.6174 14.061C37.1441 13.2746 36.4635 12.6337 35.6501 12.2084C34.8368 11.7832 33.9221 11.59 33.0062 11.6501C32.0904 11.7101 31.2087 12.0211 30.4579 12.5489C29.707 13.0768 29.116 13.8011 28.7494 14.6426C28.3829 15.484 28.2551 16.4101 28.3799 17.3194C28.5047 18.2287 28.8774 19.0861 29.4572 19.7976C30.0369 20.5092 30.8014 21.0474 31.6667 21.3534V26.6667C31.6667 28.8768 30.7887 30.9964 29.2259 32.5592C27.6631 34.122 25.5435 35 23.3334 35C21.1232 35 19.0036 34.122 17.4408 32.5592C15.878 30.9964 15 28.8768 15 26.6667V24.8667C17.7735 24.4643 20.3097 23.0778 22.1456 20.9604C23.9815 18.8429 24.9947 16.1359 25 13.3334V3.33335C25 2.89133 24.8244 2.4674 24.5119 2.15484C24.1993 1.84228 23.7754 1.66669 23.3334 1.66669H18.3334C17.8913 1.66669 17.4674 1.84228 17.1548 2.15484C16.8423 2.4674 16.6667 2.89133 16.6667 3.33335C16.6667 3.77538 16.8423 4.1993 17.1548 4.51186C17.4674 4.82443 17.8913 5.00002 18.3334 5.00002H21.6667V13.3334C21.6667 15.5435 20.7887 17.6631 19.2259 19.2259C17.6631 20.7887 15.5435 21.6667 13.3334 21.6667C11.1232 21.6667 9.0036 20.7887 7.4408 19.2259C5.87799 17.6631 5.00002 15.5435 5.00002 13.3334V5.00002H8.33335C8.77538 5.00002 9.1993 4.82443 9.51186 4.51186C9.82442 4.1993 10 3.77538 10 3.33335C10 2.89133 9.82442 2.4674 9.51186 2.15484C9.1993 1.84228 8.77538 1.66669 8.33335 1.66669H3.33335C2.89133 1.66669 2.4674 1.84228 2.15484 2.15484C1.84228 2.4674 1.66669 2.89133 1.66669 3.33335V13.3334C1.67205 16.1359 2.68517 18.8429 4.52109 20.9604C6.357 23.0778 8.89322 24.4643 11.6667 24.8667V26.6667C11.6667 29.7609 12.8959 32.7283 15.0838 34.9163C17.2717 37.1042 20.2392 38.3334 23.3334 38.3334C26.4275 38.3334 29.395 37.1042 31.5829 34.9163C33.7709 32.7283 35 29.7609 35 26.6667V21.3534C35.9723 21.0132 36.8152 20.3797 37.4122 19.5403C38.0093 18.7008 38.3311 17.6968 38.3334 16.6667Z" fill="#007A64"/>
                            </svg>
                        </div>
                    </div>
                    <div class="progress  rounded-0" style="height:4px;">
                        <div class="progress-bar rounded-0 bg-secondary progress-animated" style="width: 30%; height:4px;" role="progressbar">
                            <span class="sr-only">30% Complete</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3  col-sm-6">
                <div class="card">
                    <div class="card-body">
                        <div class="media align-items-center">
                            <div class="media-body mr-3">
                                <h2 class="fs-34 text-black font-w600">$5,034</h2>
                                <span>Ingresos</span>
                            </div>
                            <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M13.7 39.9993C15.8603 40.0123 18.0017 39.5921 20 38.763C21.9962 39.5991 24.139 40.0196 26.3 39.9993C32.861 39.9993 38 36.463 38 31.9467V24.4159C38 19.8996 32.861 16.3633 26.3 16.3633C25.9958 16.3633 25.697 16.3779 25.4 16.3943V7.87804C25.4 3.45448 20.261 0 13.7 0C7.139 0 2 3.45448 2 7.87804V32.1213C2 36.5448 7.139 39.9993 13.7 39.9993ZM34.4 31.9467C34.4 34.0358 31.0736 36.363 26.3 36.363C21.5264 36.363 18.2 34.0358 18.2 31.9467V30.2649C20.6376 31.7624 23.4476 32.5262 26.3 32.4667C29.1524 32.5262 31.9624 31.7624 34.4 30.2649V31.9467ZM26.3 19.9996C31.0736 19.9996 34.4 22.3269 34.4 24.4159C34.4 26.505 31.0736 28.8304 26.3 28.8304C21.5264 28.8304 18.2 26.5032 18.2 24.4159C18.2 22.3287 21.5264 19.9996 26.3 19.9996ZM13.7 3.6363C18.4736 3.6363 21.8 5.87262 21.8 7.87804C21.8 9.88346 18.4736 12.1216 13.7 12.1216C8.9264 12.1216 5.6 9.88528 5.6 7.87804C5.6 5.87081 8.9264 3.6363 13.7 3.6363ZM5.6 13.6034C8.04776 15.0717 10.8538 15.8181 13.7 15.7579C16.5462 15.8181 19.3522 15.0717 21.8 13.6034V16.9633C19.8383 17.4628 18.0392 18.4698 16.58 19.8851C15.6336 20.092 14.6683 20.198 13.7 20.2015C8.9264 20.2015 5.6 17.9651 5.6 15.9597V13.6034ZM5.6 21.6851C8.04828 23.1519 10.854 23.8976 13.7 23.8378C14.0204 23.8378 14.33 23.7978 14.645 23.7814C14.6182 23.9919 14.6032 24.2037 14.6 24.4159V28.2068C14.2976 28.225 14.006 28.2831 13.7 28.2831C8.9264 28.2831 5.6 26.0468 5.6 24.0396V21.6851ZM5.6 29.7649C8.04776 31.2332 10.8538 31.9796 13.7 31.9194C14.0024 31.9194 14.2994 31.8958 14.6 31.8813V31.9467C14.6258 33.4944 15.2146 34.9784 16.2542 36.1157C15.412 36.2763 14.5571 36.3591 13.7 36.363C8.9264 36.363 5.6 34.1267 5.6 32.1213V29.7649Z" fill="#007A64"/>
                            </svg>
                        </div>
                    </div>
                    <div class="progress  rounded-0" style="height:4px;">
                        <div class="progress-bar rounded-0 bg-secondary progress-animated" style="width: 94%; height:4px;" role="progressbar">
                            <span class="sr-only">94% Complete</span>
                        </div>
                    </div>
                </div>
            </div>
        @endcan
        </div>
        <div class="row">
            {{-- ESTADISTICAS DE PACIENTES --}}
            {{-- <div class="col-xl-6">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="card">
                            <div class="card-header d-sm-flex d-block pb-0 border-0">
                                <div class="mr-auto pr-3">
                                    <h4 class="text-black fs-20 mb-0">Patient Percentage</h4>
                                </div>
                                <div class="card-action card-tabs mt-3 mt-sm-0 mt-3 mb-sm-0 mb-3 mt-sm-0">
                                    <ul class="nav nav-tabs" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" data-toggle="tab" href="#Daily" role="tab">
                                                Daily
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#Weekly" role="tab">
                                                Weekly
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#Monthly" role="tab">
                                                Monthly
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="tab-content">
                                    <div class="tab-pane fade show active" id="Daily" role="tabpanel">
                                        <div class="d-flex flex-wrap align-items-center px-4 bg-light">
                                            <div class="mr-auto d-flex align-items-center py-3">
                                                <span class="heart-ai bg-primary mr-3">
                                                    <i class="fa fa-heart-o" aria-hidden="true"></i>
                                                </span>
                                                <div>
                                                    <p class="fs-18 mb-2">Total Patient</p>
                                                    <span class="fs-26 text-primary font-w600">562,084</span>
                                                </div>
                                            </div>
                                            <ul class="users pl-3 py-2">
                                                <li><img src="{{ asset('img/users/1.png') }}" alt=""></li>
                                                <li><img src="{{ asset('img/users/2.png') }}" alt=""></li>
                                                <li><img src="{{ asset('img/users/3.png') }}" alt=""></li>
                                                <li><img src="{{ asset('img/users/4.png') }}" alt=""></li>
                                                <li><img src="{{ asset('img/users/5.png') }}" alt=""></li>
                                            </ul>
                                        </div>
                                        <div class="row align-items-center">
                                            <div class="col-xl-6 col-xxl-12 col-md-6">
                                                <div id="radialBar"></div>
                                            </div>
                                            <div class="col-xl-6 col-xxl-12 col-md-6">
                                                <div class="d-flex mb-4 align-items-center">
                                                    <span class="mr-auto pr-3 font-w500 fs-30 text-black">
                                                        <svg class="mr-3" width="8" height="30" viewBox="0 0 8 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <rect width="7.65957" height="30" fill="#BDA25C"/>
                                                        </svg>
                                                        64%
                                                    </span>
                                                    <span>New Patient</span>
                                                </div>
                                                <div class="d-flex  mb-4 align-items-center">
                                                    <span class="mr-auto pr-3 font-w500 fs-30 text-black">
                                                        <svg class="mr-3" width="8" height="30" viewBox="0 0 8 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <rect width="7.65957" height="30" fill="#209F84"/>
                                                        </svg>
                                                        73%
                                                    </span>
                                                    <span>Recovered</span>
                                                </div>
                                                <div class="d-flex align-items-center">
                                                    <span class="mr-auto pr-3 font-w500 fs-30 text-black">
                                                        <svg class="mr-3" width="8" height="30" viewBox="0 0 8 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <rect width="7.65957" height="30" fill="#323232"/>
                                                        </svg>
                                                        48%
                                                    </span>
                                                    <span>In Treatment</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="Weekly" role="tabpanel">
                                        <div class="d-flex flex-wrap align-items-center px-4  bg-light">
                                            <div class="mr-auto py-3 d-flex align-items-center">
                                                <span class="heart-ai bg-primary mr-3">
                                                    <i class="fa fa-heart-o" aria-hidden="true"></i>
                                                </span>
                                                <div>
                                                    <p class="fs-18 mb-2">Total Patient</p>
                                                    <span class="fs-26 text-primary font-w600">786,360</span>
                                                </div>
                                            </div>
                                            <ul class="users pl-3 py-2">
                                                <li><img src="{{ asset('img/users/2.png') }}" alt=""></li>
                                                <li><img src="{{ asset('img/users/4.png') }}" alt=""></li>
                                                <li><img src="{{ asset('img/users/1.png') }}" alt=""></li>
                                                <li><img src="{{ asset('img/users/4.png') }}" alt=""></li>
                                                <li><img src="{{ asset('img/users/3.png') }}" alt=""></li>
                                            </ul>
                                        </div>
                                        <div class="row align-items-center">
                                            <div class="col-xl-6 col-xxl-12 col-md-6">
                                                <div id="radialBar2"></div>
                                            </div>
                                            <div class="col-xl-6 col-xxl-12 col-md-6">
                                                <div class="d-flex mb-4 align-items-center">
                                                    <span class="mr-auto pr-3 font-w500 fs-30 text-black">
                                                        <svg class="mr-3" width="8" height="30" viewBox="0 0 8 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <rect width="7.65957" height="30" fill="#BDA25C"/>
                                                        </svg>
                                                        40%
                                                    </span>
                                                    <span>New Patient</span>
                                                </div>
                                                <div class="d-flex  mb-4 align-items-center">
                                                    <span class="mr-auto pr-3 font-w500 fs-30 text-black">
                                                        <svg class="mr-3" width="8" height="30" viewBox="0 0 8 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <rect width="7.65957" height="30" fill="#209F84"/>
                                                        </svg>
                                                        81%
                                                    </span>
                                                    <span>Recovered</span>
                                                </div>
                                                <div class="d-flex align-items-center">
                                                    <span class="mr-auto pr-3 font-w500 fs-30 text-black">
                                                        <svg class="mr-3" width="8" height="30" viewBox="0 0 8 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <rect width="7.65957" height="30" fill="#323232"/>
                                                        </svg>
                                                        50%
                                                    </span>
                                                    <span>In Treatment</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="Monthly" role="tabpanel">
                                        <div class="d-flex flex-wrap align-items-center px-4  bg-light">
                                            <div class="mr-auto py-3 d-flex align-items-center">
                                                <span class="heart-ai bg-primary mr-3">
                                                    <i class="fa fa-heart-o" aria-hidden="true"></i>
                                                </span>
                                                <div>
                                                    <p class="fs-18 mb-2">Total Patient</p>
                                                    <span class="fs-26 text-primary font-w600">356,730</span>
                                                </div>
                                            </div>
                                            <ul class="users pl-3 py-2">
                                                <li><img src="{{ asset('img/users/2.png') }}" alt=""></li>
                                                <li><img src="{{ asset('img/users/4.png') }}" alt=""></li>
                                                <li><img src="{{ asset('img/users/1.png') }}" alt=""></li>
                                                <li><img src="{{ asset('img/users/4.png') }}" alt=""></li>
                                                <li><img src="{{ asset('img/users/3.png') }}" alt=""></li>
                                            </ul>
                                        </div>
                                        <div class="row align-items-center">
                                            <div class="col-xl-6 col-xxl-12 col-md-6">
                                                <div id="radialBar3"></div>
                                            </div>
                                            <div class="col-xl-6 col-xxl-12 col-md-6">
                                                <div class="d-flex mb-4 align-items-center">
                                                    <span class="mr-auto pr-3 font-w500 fs-30 text-black">
                                                        <svg class="mr-3" width="8" height="30" viewBox="0 0 8 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <rect width="7.65957" height="30" fill="#BDA25C"/>
                                                        </svg>
                                                        90%
                                                    </span>
                                                    <span>New Patient</span>
                                                </div>
                                                <div class="d-flex  mb-4 align-items-center">
                                                    <span class="mr-auto pr-3 font-w500 fs-30 text-black">
                                                        <svg class="mr-3" width="8" height="30" viewBox="0 0 8 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <rect width="7.65957" height="30" fill="#209F84"/>
                                                        </svg>
                                                        75%
                                                    </span>
                                                    <span>Recovered</span>
                                                </div>
                                                <div class="d-flex align-items-center">
                                                    <span class="mr-auto pr-3 font-w500 fs-30 text-black">
                                                        <svg class="mr-3" width="8" height="30" viewBox="0 0 8 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <rect width="7.65957" height="30" fill="#323232"/>
                                                        </svg>
                                                        30%
                                                    </span>
                                                    <span>In Treatment</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-xxl-12 col-md-6">
                        <div class="card">
                            <div class="card-header d-block border-0 pb-0">
                                <div class="d-flex mb-3">
                                    <h3 class="fs-20 text-black mb-0">Patient Overview</h3>
                                    <div class="dropdown ml-auto">
                                        <div class="btn-link" data-toggle="dropdown">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M13.0001 12C13.0001 11.4477 12.5523 11 12.0001 11C11.4478 11 11.0001 11.4477 11.0001 12C11.0001 12.5523 11.4478 13 12.0001 13C12.5523 13 13.0001 12.5523 13.0001 12Z" stroke="#2E2E2E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M6.00006 12C6.00006 11.4477 5.55235 11 5.00006 11C4.44778 11 4.00006 11.4477 4.00006 12C4.00006 12.5523 4.44778 13 5.00006 13C5.55235 13 6.00006 12.5523 6.00006 12Z" stroke="#2E2E2E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M20.0001 12C20.0001 11.4477 19.5523 11 19.0001 11C18.4478 11 18.0001 11.4477 18.0001 12C18.0001 12.5523 18.4478 13 19.0001 13C19.5523 13 20.0001 12.5523 20.0001 12Z" stroke="#2E2E2E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                        </div>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item text-black" href="javascript:;">Info</a>
                                            <a class="dropdown-item text-black" href="javascript:;">Details</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex">
                                    <div class="d-flex mr-auto align-items-center">
                                        <svg width="12" height="54" viewBox="0 0 12 54" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <rect width="12" height="54" fill="#BDA25C"/>
                                        </svg>
                                        <div class="ml-2">
                                            <p class="mb-1">New</p>
                                            <span class="text-black font-w500">451</span>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <svg width="12" height="54" viewBox="0 0 12 54" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <rect width="12" height="54" fill="#209F84"/>
                                        </svg>
                                        <div class="ml-2">
                                            <p class="mb-1">Recovered</p>
                                            <span class="text-black font-w500">623</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body p-0">
                                <div id="chartTimeline"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-xxl-12 col-md-6">
                        <div class="card">
                            <div class="card-header border-0 pb-0">
                                <h3 class="fs-20 text-black mb-0">Visitors</h3>
                                <div class="dropdown ml-auto">
                                    <div class="btn-link" data-toggle="dropdown">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M13.0001 12C13.0001 11.4477 12.5523 11 12.0001 11C11.4478 11 11.0001 11.4477 11.0001 12C11.0001 12.5523 11.4478 13 12.0001 13C12.5523 13 13.0001 12.5523 13.0001 12Z" stroke="#2E2E2E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                            <path d="M6.00006 12C6.00006 11.4477 5.55235 11 5.00006 11C4.44778 11 4.00006 11.4477 4.00006 12C4.00006 12.5523 4.44778 13 5.00006 13C5.55235 13 6.00006 12.5523 6.00006 12Z" stroke="#2E2E2E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                            <path d="M20.0001 12C20.0001 11.4477 19.5523 11 19.0001 11C18.4478 11 18.0001 11.4477 18.0001 12C18.0001 12.5523 18.4478 13 19.0001 13C19.5523 13 20.0001 12.5523 20.0001 12Z" stroke="#2E2E2E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                    </div>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item text-black" href="javascript:;">Info</a>
                                        <a class="dropdown-item text-black" href="javascript:;">Details</a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body pb-0">
                                <ul class="users-sm mb-3">
                                    <li><img src="{{ asset('img/users/6.png') }}" alt=""></li>
                                    <li><img src="{{ asset('img/users/7.png') }}" alt=""></li>
                                    <li><img src="{{ asset('img/users/8.png') }}" alt=""></li>
                                    <li><img src="{{ asset('img/users/9.png') }}" alt=""></li>
                                    <li><img src="{{ asset('img/users/10.png') }}" alt=""></li>
                                </ul>
                                <div class="d-flex align-items-center">
                                    <svg class="mr-3" width="30" height="19" viewBox="0 0 30 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M28.8124 0.990788C29.6459 1.71558 29.734 2.97884 29.0092 3.81236L20.2578 13.8765C18.859 15.4851 16.4444 15.7141 14.7681 14.397L10.6176 11.1359L3.37074 17.9564C2.56639 18.7134 1.30064 18.6751 0.543606 17.8707C-0.213427 17.0664 -0.175071 15.8006 0.629276 15.0436L7.8761 8.22306C9.317 6.86692 11.5329 6.76809 13.0888 7.99059L17.2394 11.2517L25.9908 1.18764C26.7156 0.354128 27.9788 0.265993 28.8124 0.990788Z" fill="#007A64"/>
                                    </svg>
                                    <div>
                                        <p class="fs-12 mb-0">Customer</p>
                                        <span class="fs-22 text-black font-w600">765 Person</span>
                                    </div>
                                </div>
                                <div id="lineChart"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-12">
                        <div class="card rated-doctors">
                            <div class="card-header border-0 pb-0">
                                <h3 class="fs-20 text-black mb-0 mr-auto">Top Rated Doctors</h3>
                                <a href="javascript:void(0)" class="btn-link">More >></a>
                            </div>
                            <div class="card-body">
                                <div class="d-sm-flex pb-sm-4 pb-3 border-bottom mb-sm-4 mb-3 align-items-center">
                                    <div class="d-flex align-items-center mr-auto pr-2">
                                        <span class="num mr-sm-4 mr-3">#1</span>
                                        <img src="{{ asset('img/users/1.jpg') }}" class="img-1 mr-sm-4 mr-3" alt="">
                                        <div>
                                            <h4 class="mb-sm-2 mb-1"><a href="doctor.html" class="text-black">Dr. Samantha Queque</a></h4>
                                            <span class="fs-14 text-primary font-w600">Gynecologist</span>
                                        </div>
                                    </div>
                                    <div class="text-sm-right mt-sm-0 mt-3 star-review">
                                        <ul>
                                            <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                            <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                            <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                            <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                            <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                        </ul>
                                        <span class="fs-14 text-black">315 reviews</span>
                                    </div>
                                </div>
                                <div class="d-sm-flex pb-sm-4 pb-3 border-bottom mb-sm-4 mb-3 align-items-center">
                                    <div class="d-flex align-items-center mr-auto pr-2">
                                        <span class="num mr-sm-4 mr-3">#2</span>
                                        <img src="{{ asset('img/users/2.jpg') }}" class="img-1 mr-sm-4 mr-3" alt="">
                                        <div>
                                            <h4 class="mb-sm-2 mb-1"><a href="doctor.html" class="text-black">Dr. Samuel Jr.</a></h4>
                                            <span class="fs-14 text-primary font-w600">Gynecologist</span>
                                        </div>
                                    </div>
                                    <div class="text-sm-right mt-sm-0 mt-3 star-review">
                                        <ul>
                                            <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                            <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                            <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                            <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                            <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                        </ul>
                                        <span class="fs-14 text-black">221 reviews</span>
                                    </div>
                                </div>
                                <div class="d-sm-flex pb-sm-4 pb-3 border-bottom mb-sm-4 mb-3 align-items-center">
                                    <div class="d-flex align-items-center mr-auto pr-2">
                                        <span class="num mr-sm-4 mr-3">#3</span>
                                        <img src="{{ asset('img/users/3.jpg') }}" class="img-1 mr-sm-4 mr-3" alt="">
                                        <div>
                                            <h4 class="mb-sm-2 mb-1"><a href="doctor.html" class="text-black">Dr. Jennifer Ruby</a></h4>
                                            <span class="fs-14 text-primary font-w600">Gynecologist</span>
                                        </div>
                                    </div>
                                    <div class="text-sm-right mt-sm-0 mt-3 star-review">
                                        <ul>
                                            <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                            <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                            <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                            <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                            <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                        </ul>
                                        <span class="fs-14 text-black">181 reviews</span>
                                    </div>
                                </div>
                                <div class="d-sm-flex pb-sm-4 pb-3 border-bottom mb-sm-4 mb-3 align-items-center">
                                    <div class="d-flex align-items-center mr-auto pr-2">
                                        <span class="num mr-sm-4 mr-3">#4</span>
                                        <img src="{{ asset('img/users/4.jpg') }}" class="img-1 mr-sm-4 mr-3" alt="">
                                        <div>
                                            <h4 class="mb-sm-2 mb-1"><a href="doctor.html" class="text-black">Dr. Abdul Aziz Lazis</a></h4>
                                            <span class="fs-14 text-primary font-w600">Gynecologist</span>
                                        </div>
                                    </div>
                                    <div class="text-sm-right mt-sm-0 mt-3 star-review">
                                        <ul>
                                            <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                            <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                            <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                            <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                            <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                        </ul>
                                        <span class="fs-14 text-black">315 reviews</span>
                                    </div>
                                </div>
                                <div class="d-sm-flex pb-sm-4 pb-3 border-bottom mb-sm-4 mb-3 align-items-center">
                                    <div class="d-flex align-items-center mr-auto pr-2">
                                        <span class="num mr-sm-4 mr-3">#5</span>
                                        <img src="{{ asset('img/users/5.jpg') }}" class="img-1 mr-sm-4 mr-3" alt="">
                                        <div>
                                            <h4 class="mb-sm-2 mb-1"><a href="doctor.html" class="text-black">Dr. Alex Siauw</a></h4>
                                            <span class="fs-14 text-primary font-w600">Gynecologist</span>
                                        </div>
                                    </div>
                                    <div class="text-sm-right mt-sm-0 mt-3 star-review">
                                        <ul>
                                            <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                            <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                            <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                            <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                            <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                        </ul>
                                        <span class="fs-14 text-black">176 reviews</span>
                                    </div>
                                </div>
                                <div class="d-sm-flex pb-0 align-items-center">
                                    <div class="d-flex align-items-center mr-auto pr-2">
                                        <span class="num mr-sm-4 mr-3">#6</span>
                                        <img src="{{ asset('img/users/1.jpg') }}" class="img-1 mr-sm-4 mr-3" alt="">
                                        <div>
                                            <h4 class="mb-sm-2 mb-1"><a href="doctor.html" class="text-black">Dr. Abdul Aziz Lazis</a></h4>
                                            <span class="fs-14 text-primary font-w600">Gynecologist</span>
                                        </div>
                                    </div>
                                    <div class="text-sm-right mt-sm-0 mt-3 star-review">
                                        <ul>
                                            <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                            <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                            <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                            <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                            <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                        </ul>
                                        <span class="fs-14 text-black">315 reviews</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}
            <div class="col-xl-12">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="card appointment-schedule">
                            <div class="card-header pb-0 border-0">
                                <h3 class="fs-20 text-black mb-0">Solicitud de Citas</h3>
                                <div class="dropdown ml-auto">
                                    <div class="btn-link p-2 bg-light" data-toggle="dropdown">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M12 13C12.5523 13 13 12.5523 13 12C13 11.4477 12.5523 11 12 11C11.4477 11 11 11.4477 11 12C11 12.5523 11.4477 13 12 13Z" stroke="#2E2E2E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                            <path d="M12 6C12.5523 6 13 5.55228 13 5C13 4.44772 12.5523 4 12 4C11.4477 4 11 4.44772 11 5C11 5.55228 11.4477 6 12 6Z" stroke="#2E2E2E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                            <path d="M12 20C12.5523 20 13 19.5523 13 19C13 18.4477 12.5523 18 12 18C11.4477 18 11 18.4477 11 19C11 19.5523 11.4477 20 12 20Z" stroke="#2E2E2E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                    </div>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        {{-- <a class="dropdown-item text-black" href="javascript:;">Info</a> --}}
                                        <a class="dropdown-item text-black" href="{{ route('citas.index') }}">Ver todas</a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-xl-6 col-xxl-12 col-md-6">
                                        <div class="appointment-calender">
                                            <input type='text' class="form-control d-none" id='datetimepicker1' />
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-xxl-12  col-md-6 height415 dz-scroll" id="appointment-schedule">
                    @can('super-admin')
                        @php
                            setlocale(LC_ALL, 'Spanish_Venezuela');
                            for ($i=0; $i < count($datos); $i++) {
                                        echo '<div class="d-flex pb-3 border-bottom mb-3 align-items-end">
                                            <div class="mr-auto">
                                                <p class="text-black font-w600 mb-2">'. utf8_encode(strftime("%A, %d de %B", strtotime($datos[$i]['cita_fecha']))) .'</p>
                                                <ul>
                                                    <li><i class="las la-clock"></i>' . $datos[$i]['cita_hora'] . '</li>
                                                    <li><i class="las la-stethoscope"></i>' . $datos[$i]['specialist_degree'] . " " . $datos[$i]['specialist_name'] . '</li>
                                                    <li><i class="las la-user"></i>' . $datos[$i]['paciente_name'] . '</li>
                                                    <li><i class="las la-eye"></i>' . $datos[$i]['cita_tipo'] . '</li>';
                                                    switch ($datos[$i]['cita_status']) {
                                                        case 0:
                                                            echo '<li class="btn btn-warning text-nowrap btn-sm">Solicitada</li>';
                                                            break;
                                                        case 1:
                                                        case 7:
                                                            echo '<li class="btn btn-success text-nowrap btn-sm">Aceptada</li>';
                                                            break;
                                                        case 2:
                                                        case 3:
                                                            echo '<li class="btn btn-danger text-nowrap btn-sm light">Rechazada</li>';
                                                            break;
                                                        case 4:
                                                        case 5:
                                                        case 6:
                                                            echo '<li class="btn btn-danger text-nowrap btn-sm">Cancelada</li>';
                                                            break;
                                                        case 8:
                                                            echo '<li class="btn btn-info text-nowrap btn-sm">Concluida</li>';
                                                            break;
                                                    }
                                            echo    '</ul>
                                            </div>';
                                            switch ($datos[$i]['cita_status']) {
                                                case 0:
                                                    echo    Form::submit('Reprogramar', ['class' => 'btn btn-info']);
                                                    $cancelar = array('cita' => $datos[$i]['cita_id'], 'id' => $datos[$i]['cita_id'], 'status' => 4);
                                                    echo Form::open(['method' => 'PATCH','route' => ['citas.update', $cancelar], 'style'=>'display:inline']);
                                                    echo    Form::submit('Cancelar', ['class' => 'btn btn-danger light']);
                                                    echo Form::close();
                                                    break;
                                                case 1:
                                                case 7:
                                                    echo    Form::submit('Reprogramar', ['class' => 'btn btn-info']);
                                                    $cancelar = array('cita' => $datos[$i]['cita_id'], 'id' => $datos[$i]['cita_id'], 'status' => 4);
                                                    echo Form::open(['method' => 'PATCH','route' => ['citas.update', $cancelar], 'style'=>'display:inline']);
                                                    echo    Form::submit('Cancelar', ['class' => 'btn btn-danger light']);
                                                    echo Form::close();
                                                    break;
                                                case 2:
                                                case 3:
                                                    echo    Form::submit('Reprogramar', ['class' => 'btn btn-info']);
                                                    break;
                                            }

                                            echo '
                                        </div>';
                            }
                        @endphp
                    @elsecan('specialist-view')
                        @php
                            setlocale(LC_ALL, 'Spanish_Venezuela');
                            for ($i=0; $i < count($datos); $i++) {
                                        echo '<div class="d-flex pb-3 border-bottom mb-3 align-items-end">
                                            <div class="mr-auto">';
                                        echo    '<p class="text-black font-w600 mb-2">'. utf8_encode(strftime("%A, %d de %B", strtotime($datos[$i]['cita_fecha']))) .'</p>
                                                <ul>
                                                    <li><i class="las la-clock"></i>' . $datos[$i]['cita_hora'] . '</li>
                                                    <li><i class="las la-stethoscope"></i>' . $datos[$i]['specialist_degree'] . " " . $datos[$i]['specialist_name'] . '</li>
                                                    <li><i class="las la-user"></i>' . $datos[$i]['paciente_name'] . '</li>
                                                    <li><i class="las la-eye"></i>' . $datos[$i]['cita_tipo'] . '</li>';
                                                    switch ($datos[$i]['cita_status']) {
                                                        case 0:
                                                            echo '<li class="btn btn-warning text-nowrap btn-sm">Solicitada</li>';
                                                            break;
                                                        case 1:
                                                        case 7:
                                                            echo '<li class="btn btn-success text-nowrap btn-sm">Aceptada</li>';
                                                            break;
                                                        case 2:
                                                        case 3:
                                                            echo '<li class="btn btn-danger text-nowrap btn-sm light">Rechazada</li>';
                                                            break;
                                                        case 4:
                                                        case 5:
                                                        case 6:
                                                            echo '<li class="btn btn-danger text-nowrap btn-sm">Cancelada</li>';
                                                            break;
                                                        case 8:
                                                            echo '<li class="btn btn-info text-nowrap btn-sm">Concluida</li>';
                                                            break;
                                                    }
                                            echo    '</ul>
                                            </div>';
                                                switch ($datos[$i]['cita_status']) {
                                                    case 0:
                                                        $aceptar = array('cita' => $datos[$i]['cita_id'], 'id' => $datos[$i]['cita_id'], 'status' => 1);
                                                        echo Form::open(['method' => 'PATCH','route' => ['citas.update', $aceptar], 'style'=>'display:inline']);
                                                        echo    Form::submit('Aceptar', ['class' => 'btn btn-primary']);
                                                        echo Form::close();
                                                        $rechazar = array('cita' => $datos[$i]['cita_id'], 'id' => $datos[$i]['cita_id'], 'status' => 2);
                                                        echo Form::open(['method' => 'PATCH','route' => ['citas.update', $rechazar], 'style'=>'display:inline']);
                                                        echo    Form::submit('Rechazar', ['class' => 'btn btn-danger']);
                                                        echo Form::close();
                                                        $cancelar = array('cita' => $datos[$i]['cita_id'], 'id' => $datos[$i]['cita_id'], 'status' => 4);
                                                        echo Form::open(['method' => 'PATCH','route' => ['citas.update', $cancelar], 'style'=>'display:inline']);
                                                        echo    Form::submit('Cancelar', ['class' => 'btn btn-danger light']);
                                                        echo Form::close();
                                                        /* echo    Form::submit('Reprogramar', ['class' => 'btn btn-info']); */
                                                        break;
                                                    case 1:
                                                    case 7:
                                                    
                                                        echo '<div class="modal fade" id="calificar'.$i.'">
                                                            <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Calificar</h5>
                                                                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">';
                                                        echo        Form::open(array('route' => 'score.store','method'=>'POST'));
                                                        echo        '<div class="form-group">
                                                                            <h3 class="text-black font-w500">¿Cómo le fue con el ' . $datos[$i]['specialist_degree'] . " " . $datos[$i]['specialist_name'] . '?</h3>
                                                                            <h5>En la cita del '. utf8_encode(strftime("%A, %d de %B", strtotime($datos[$i]['cita_fecha']))) .'</h5>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label class="text-black font-w500">¿Cuantos <i class="fa-solid fa-heart" style="color: red"></i> le das?</label>';
                                                                            $optionsTipo = [
                                                                                '3' => '3',
                                                                                '2' => '2',
                                                                                '0' => '0',
                                                                                '-1' => '-1',
                                                                                '-2' => '-2',
                                                                                '-3' => '-3'
                                                                            ];
                                                        echo        Form::select('score', $optionsTipo,[], array('placeholder' => 'Escoja su puntuación','class' => 'form-control','simple','fa'));
                                                        echo            '</div>
                                                                        <div class="form-group">';
                                                        echo        Form::textarea('commit', null, array('placeholder' => 'Escriba aquí una breve opinión sobre su experiencia','class' => 'form-control'));
                                                        echo            '</div>';
                                                        echo        Form::text('customer_id', $datos[$i]['paciente_id'], array('hidden'));
                                                        echo        Form::text('specialist_id', $datos[$i]['specialist_id'], array('hidden'));
                                                        echo        Form::text('cita_id', $datos[$i]['cita_id'], array('hidden'));
                                                        echo            '<small>Le notificaremos cuando le sea asignado un especialista y sea aceptada su solicitud.</small>
                                                                        <div class="form-group">
                                                                            <button type="submit" class="btn btn-primary"><i class="fa-solid fa-heart"></i> Calificar</button>
                                                                        </div>';
                                                        echo        Form::close();
                                                        echo    '</div>
                                                            </div>
                                                        </div></div>';
                                                        echo '<a href="javascript:void(0)" class="btn btn-warning" data-toggle="modal" data-target="#calificar'.$i.'"><i class="fa-solid fa-heart"></i>Calificar</a>';
                                                        $cancelar = array('cita' => $datos[$i]['cita_id'], 'id' => $datos[$i]['cita_id'], 'status' => 4);
                                                        echo Form::open(['method' => 'PATCH','route' => ['citas.update', $cancelar], 'style'=>'display:inline']);
                                                        echo    Form::submit('Cancelar', ['class' => 'btn btn-danger light']);
                                                        echo Form::close();
                                                    
                                                        break;
                                                    case 4:
                                                    case 5:
                                                    case 6:
                                                        echo '<div class="modal fade" id="calificar'.$i.'">
                                                            <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Calificar</h5>
                                                                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">';
                                                        echo        Form::open(array('route' => 'score.store','method'=>'POST'));
                                                        echo        '<div class="form-group">
                                                                            <h3 class="text-black font-w500">¿Cómo le fue con el ' . $datos[$i]['specialist_degree'] . " " . $datos[$i]['specialist_name'] . '?</h3>
                                                                            <h5>En la cita del '. utf8_encode(strftime("%A, %d de %B", strtotime($datos[$i]['cita_fecha']))) .'</h5>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label class="text-black font-w500">¿Cuantos <i class="fa-solid fa-heart" style="color: red"></i> le das?</label>';
                                                                            $optionsTipo = [
                                                                                '3' => '3',
                                                                                '2' => '2',
                                                                                '0' => '0',
                                                                                '-1' => '-1',
                                                                                '-2' => '-2',
                                                                                '-3' => '-3'
                                                                            ];
                                                        echo        Form::select('score', $optionsTipo,[], array('placeholder' => 'Escoja su puntuación','class' => 'form-control','simple','fa'));
                                                        echo            '</div>
                                                                        <div class="form-group">';
                                                        echo        Form::textarea('commit', null, array('placeholder' => 'Escriba aquí una breve opinión sobre su experiencia','class' => 'form-control'));
                                                        echo            '</div>';
                                                        echo        Form::text('customer_id', $datos[$i]['paciente_id'], array('hidden'));
                                                        echo        Form::text('specialist_id', $datos[$i]['specialist_id'], array('hidden'));
                                                        echo        Form::text('cita_id', $datos[$i]['cita_id'], array('hidden'));
                                                        echo            '<small>Le notificaremos cuando le sea asignado un especialista y sea aceptada su solicitud.</small>
                                                                        <div class="form-group">
                                                                            <button type="submit" class="btn btn-primary"><i class="fa-solid fa-heart"></i> Calificar</button>
                                                                        </div>';
                                                        echo        Form::close();
                                                        echo    '</div>
                                                            </div>
                                                        </div></div>';
                                                        echo '<a href="javascript:void(0)" class="btn btn-warning" data-toggle="modal" data-target="#calificar'.$i.'"><i class="fa-solid fa-heart"></i>Calificar</a>';
                                                        break;
                                                    case 8:
                                                        if ($datos[$i]['score'] == NULL) {
                                                        echo '<div class="modal fade" id="calificar'.$i.'">
                                                            <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Calificar</h5>
                                                                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">';
                                                        echo        Form::open(array('route' => 'score.store','method'=>'POST'));
                                                        echo        '<div class="form-group">
                                                                            <h3 class="text-black font-w500">¿Cómo le fue con el ' . $datos[$i]['specialist_degree'] . " " . $datos[$i]['specialist_name'] . '?</h3>
                                                                            <h5>En la cita del '. utf8_encode(strftime("%A, %d de %B", strtotime($datos[$i]['cita_fecha']))) .'</h5>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label class="text-black font-w500">¿Cuantos <i class="fa-solid fa-heart" style="color: red"></i> le das?</label>';
                                                                            $optionsTipo = [
                                                                                '3' => '3',
                                                                                '2' => '2',
                                                                                '0' => '0',
                                                                                '-1' => '-1',
                                                                                '-2' => '-2',
                                                                                '-3' => '-3'
                                                                            ];
                                                        echo        Form::select('score', $optionsTipo,[], array('placeholder' => 'Escoja su puntuación','class' => 'form-control','simple','fa'));
                                                        echo            '</div>
                                                                        <div class="form-group">';
                                                        echo        Form::textarea('commit', null, array('placeholder' => 'Escriba aquí una breve opinión sobre su experiencia','class' => 'form-control'));
                                                        echo            '</div>';
                                                        echo        Form::text('customer_id', $datos[$i]['paciente_id'], array('hidden'));
                                                        echo        Form::text('specialist_id', $datos[$i]['specialist_id'], array('hidden'));
                                                        echo        Form::text('cita_id', $datos[$i]['cita_id'], array('hidden'));
                                                        echo            '<small>Le notificaremos cuando le sea asignado un especialista y sea aceptada su solicitud.</small>
                                                                        <div class="form-group">
                                                                            <button type="submit" class="btn btn-primary"><i class="fa-solid fa-heart"></i> Calificar</button>
                                                                        </div>';
                                                        echo        Form::close();
                                                        echo    '</div>
                                                            </div>
                                                        </div></div>';
                                                        echo '<a href="javascript:void(0)" class="btn btn-warning" data-toggle="modal" data-target="#calificar'.$i.'"><i class="fa-solid fa-heart"></i> Calificar</a>';
                                                        }
                                                        break;
                                                }
                                            echo '
                                        </div>';
                            }
                        @endphp
                    @elsecan('customer-view')
                        @php
                            setlocale(LC_ALL, 'Spanish_Venezuela');
                            for ($i=0; $i < count($datos); $i++) {
                                        echo '<div class="d-flex pb-3 border-bottom mb-3 align-items-end">
                                            <div class="mr-auto">';
                                        echo    '<p class="text-black font-w600 mb-2">'. utf8_encode(strftime("%A, %d de %B", strtotime($datos[$i]['cita_fecha']))) .'</p>
                                                <ul>
                                                    <li><i class="las la-clock"></i>' . $datos[$i]['cita_hora'] . '</li>
                                                    <li><i class="las la-stethoscope"></i>' . $datos[$i]['specialist_degree'] . " " . $datos[$i]['specialist_name'] . '</li>
                                                    <li><i class="las la-user"></i>' . $datos[$i]['paciente_name'] . '</li>
                                                    <li><i class="las la-eye"></i>' . $datos[$i]['cita_tipo'] . '</li>';
                                                    switch ($datos[$i]['cita_status']) {
                                                        case 0:
                                                            echo '<li class="btn btn-warning text-nowrap btn-sm">Solicitada</li>';
                                                            break;
                                                        case 1:
                                                        case 7:
                                                            echo '<li class="btn btn-success text-nowrap btn-sm">Aceptada</li>';
                                                            break;
                                                        case 2:
                                                        case 3:
                                                            echo '<li class="btn btn-danger text-nowrap btn-sm light">Rechazada</li>';
                                                            break;
                                                        case 4:
                                                        case 5:
                                                        case 6:
                                                            echo '<li class="btn btn-danger text-nowrap btn-sm">Cancelada</li>';
                                                            break;
                                                        case 8:
                                                            echo '<li class="btn btn-info text-nowrap btn-sm">Concluida</li>';
                                                            break;
                                                    }
                                            echo    '</ul>
                                            </div>';
                                                switch ($datos[$i]['cita_status']) {
                                                    case 0:
                                                    $cancelar = array('cita' => $datos[$i]['cita_id'], 'id' => $datos[$i]['cita_id'], 'status' => 4);
                                                    echo Form::open(['method' => 'PATCH','route' => ['citas.update', $cancelar], 'style'=>'display:inline']);
                                                    echo    Form::submit('Cancelar', ['class' => 'btn btn-danger light']);
                                                    echo Form::close();
                                                    break;
                                                    case 1:
                                                    case 7:
                                                        echo '<div class="modal fade" id="calificar'.$i.'">
                                                            <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Calificar</h5>
                                                                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">';
                                                        echo        Form::open(array('route' => 'scorecustomer.store','method'=>'POST'));
                                                        echo        '<div class="form-group">
                                                                            <h3 class="text-black font-w500">¿Cómo le fue con el ' . $datos[$i]['specialist_degree'] . " " . $datos[$i]['specialist_name'] . '?</h3>
                                                                            <h5>En la cita del '. utf8_encode(strftime("%A, %d de %B", strtotime($datos[$i]['cita_fecha']))) .'</h5>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label class="text-black font-w500">¿Cuantos <i class="fa-solid fa-heart" style="color: red"></i> le das?</label>';
                                                                            $optionsTipo = [
                                                                                '3' => '3',
                                                                                '2' => '2',
                                                                                '0' => '0',
                                                                                '-1' => '-1',
                                                                                '-2' => '-2',
                                                                                '-3' => '-3'
                                                                            ];
                                                        echo        Form::select('score', $optionsTipo,[], array('placeholder' => 'Escoja su puntuación','class' => 'form-control','simple','fa'));
                                                        echo            '</div>
                                                                        <div class="form-group">';
                                                        echo        Form::textarea('commit', null, array('placeholder' => 'Escriba aquí una breve opinión sobre su experiencia','class' => 'form-control'));
                                                        echo            '</div>';
                                                        echo        Form::text('customer_id', $datos[$i]['paciente_id'], array('hidden'));
                                                        echo        Form::text('specialist_id', $datos[$i]['specialist_id'], array('hidden'));
                                                        echo        Form::text('cita_id', $datos[$i]['cita_id'], array('hidden'));
                                                        echo            '<small>Le notificaremos cuando le sea asignado un especialista y sea aceptada su solicitud.</small>
                                                                        <div class="form-group">
                                                                            <button type="submit" class="btn btn-primary"><i class="fa-solid fa-heart"></i> Calificar</button>
                                                                        </div>';
                                                        echo        Form::close();
                                                        echo    '</div>
                                                            </div>
                                                        </div></div>';
                                                        echo '<a href="javascript:void(0)" class="btn btn-warning" data-toggle="modal" data-target="#calificar'.$i.'"><i class="fa-solid fa-heart"></i>Calificar</a>';
                                                        $cancelar = array('cita' => $datos[$i]['cita_id'], 'id' => $datos[$i]['cita_id'], 'status' => 4);
                                                        echo Form::open(['method' => 'PATCH','route' => ['citas.update', $cancelar], 'style'=>'display:inline']);
                                                        echo    Form::submit('Cancelar', ['class' => 'btn btn-danger light']);
                                                        echo Form::close();
                                                        break;
                                                    case 3:
                                                        echo    Form::submit('Reprogramar', ['class' => 'btn btn-info']);
                                                        break;
                                                    case 4:
                                                    case 5:
                                                    case 6:
                                                        echo '<div class="modal fade" id="calificar'.$i.'">
                                                            <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Calificar</h5>
                                                                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">';
                                                        echo        Form::open(array('route' => 'scorecustomer.store','method'=>'POST'));
                                                        echo        '<div class="form-group">
                                                                            <h3 class="text-black font-w500">¿Cómo le fue con el ' . $datos[$i]['specialist_degree'] . " " . $datos[$i]['specialist_name'] . '?</h3>
                                                                            <h5>En la cita del '. utf8_encode(strftime("%A, %d de %B", strtotime($datos[$i]['cita_fecha']))) .'</h5>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label class="text-black font-w500">¿Cuantos <i class="fa-solid fa-heart" style="color: red"></i> le das?</label>';
                                                                            $optionsTipo = [
                                                                                '3' => '3',
                                                                                '2' => '2',
                                                                                '0' => '0',
                                                                                '-1' => '-1',
                                                                                '-2' => '-2',
                                                                                '-3' => '-3'
                                                                            ];
                                                        echo        Form::select('score', $optionsTipo,[], array('placeholder' => 'Escoja su puntuación','class' => 'form-control','simple','fa'));
                                                        echo            '</div>
                                                                        <div class="form-group">';
                                                        echo        Form::textarea('commit', null, array('placeholder' => 'Escriba aquí una breve opinión sobre su experiencia','class' => 'form-control'));
                                                        echo            '</div>';
                                                        echo        Form::text('customer_id', $datos[$i]['paciente_id'], array('hidden'));
                                                        echo        Form::text('specialist_id', $datos[$i]['specialist_id'], array('hidden'));
                                                        echo        Form::text('cita_id', $datos[$i]['cita_id'], array('hidden'));
                                                        echo            '<small>Le notificaremos cuando le sea asignado un especialista y sea aceptada su solicitud.</small>
                                                                        <div class="form-group">
                                                                            <button type="submit" class="btn btn-primary"><i class="fa-solid fa-heart"></i> Calificar</button>
                                                                        </div>';
                                                        echo        Form::close();
                                                        echo    '</div>
                                                            </div>
                                                        </div></div>';
                                                        echo '<a href="javascript:void(0)" class="btn btn-warning" data-toggle="modal" data-target="#calificar'.$i.'"><i class="fa-solid fa-heart"></i>Calificar</a>';
                                                        break;
                                                    case 8:
                                                    if ($datos[$i]['score_customers'] == NULL) {
                                                        echo '<div class="modal fade" id="calificar'.$i.'">
                                                            <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Calificar</h5>
                                                                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">';
                                                        echo        Form::open(array('route' => 'scorecustomer.store','method'=>'POST'));
                                                        echo        '<div class="form-group">
                                                                            <h3 class="text-black font-w500">¿Cómo le fue con el ' . $datos[$i]['specialist_degree'] . " " . $datos[$i]['specialist_name'] . '?</h3>
                                                                            <h5>En la cita del '. utf8_encode(strftime("%A, %d de %B", strtotime($datos[$i]['cita_fecha']))) .'</h5>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label class="text-black font-w500">¿Cuantos <i class="fa-solid fa-heart" style="color: red"></i> le das?</label>';
                                                                            $optionsTipo = [
                                                                                '3' => '3',
                                                                                '2' => '2',
                                                                                '0' => '0',
                                                                                '-1' => '-1',
                                                                                '-2' => '-2',
                                                                                '-3' => '-3'
                                                                            ];
                                                        echo        Form::select('score', $optionsTipo,[], array('placeholder' => 'Escoja su puntuación','class' => 'form-control','simple','fa'));
                                                        echo            '</div>
                                                                        <div class="form-group">';
                                                        echo        Form::textarea('commit', null, array('placeholder' => 'Escriba aquí una breve opinión sobre su experiencia','class' => 'form-control'));
                                                        echo            '</div>';
                                                        echo        Form::text('customer_id', $datos[$i]['paciente_id'], array('hidden'));
                                                        echo        Form::text('specialist_id', $datos[$i]['specialist_id'], array('hidden'));
                                                        echo        Form::text('cita_id', $datos[$i]['cita_id'], array('hidden'));
                                                        echo            '<small>Le notificaremos cuando le sea asignado un especialista y sea aceptada su solicitud.</small>
                                                                        <div class="form-group">
                                                                            <button type="submit" class="btn btn-primary"><i class="fa-solid fa-heart"></i> Calificar</button>
                                                                        </div>';
                                                        echo        Form::close();
                                                        echo    '</div>
                                                            </div>
                                                        </div></div>';
                                                        echo '<a href="javascript:void(0)" class="btn btn-warning" data-toggle="modal" data-target="#calificar'.$i.'"><i class="fa-solid fa-heart"></i>Calificar</a>';
                                                    }
                                                    break;
                                            }
                                            echo '
                                        </div>';
                            }
                        @endphp
                    @endcan
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-12">
                        <div class="card patient-activity">
                            <div class="card-header border-0 pb-0">
                                <h3 class="fs-20 text-black mb-0"><i class="fa-solid fa-heart" style="color: red"></i> Calificaciones</h3>
                                <div class="dropdown ml-auto">
                                    <div class="btn-link" data-toggle="dropdown">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M13.0001 12C13.0001 11.4477 12.5523 11 12.0001 11C11.4478 11 11.0001 11.4477 11.0001 12C11.0001 12.5523 11.4478 13 12.0001 13C12.5523 13 13.0001 12.5523 13.0001 12Z" stroke="#2E2E2E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                            <path d="M6.00006 12C6.00006 11.4477 5.55235 11 5.00006 11C4.44778 11 4.00006 11.4477 4.00006 12C4.00006 12.5523 4.44778 13 5.00006 13C5.55235 13 6.00006 12.5523 6.00006 12Z" stroke="#2E2E2E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                            <path d="M20.0001 12C20.0001 11.4477 19.5523 11 19.0001 11C18.4478 11 18.0001 11.4477 18.0001 12C18.0001 12.5523 18.4478 13 19.0001 13C19.5523 13 20.0001 12.5523 20.0001 12Z" stroke="#2E2E2E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                        </svg>
                                    </div>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        {{-- <a class="dropdown-item text-black" href="javascript:;">Info</a> --}}
                                        <a class="dropdown-item text-black" href="javascript:;">Ver todas</a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body pb-0" >
                                <div class="table-responsive height720 dz-scroll" id="patient-activity">
                                    <table class="table table-responsive-sm">
                                        <tbody>
                            @php
                                for ($sc=0; $sc < count($datos); $sc++) { 
                                    if ($datos[$sc]['score_customers'] != NULL) {
                                        echo '<tr>
                                                <td>
                                                    <div class="d-flex">
                                                        <img src="thumbnail/profile/' . $datos[$sc]['paciente_avatar'] . '" alt="" class="img-2 mr-3">
                                                        <div>
                                                            
                                                            <h6 class="fs-16 mb-1"><a href="' . route('users.show', ($datos[$sc]['role'] != "Customer" ? $datos[$sc]['paciente_id'] : $datos[$sc]['specialist_user_id'])) . '" class="text-black">' . ($datos[$sc]['role'] != "Customer" ? $datos[$sc]['paciente_name'] : $datos[$sc]['specialist_name']) . '</a></h6>
                                                            <small class="text-muted">Fecha: ' . $datos[$sc]['score_customers_date'] . '</small>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div>
                                                        <p class="fs-14 mb-1">Comentario</p>
                                                        <span class="text-primary font-w600 mb-auto">' . $datos[$sc]['score_customers_commit'] . '</span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div>
                                                        <p class="fs-14 mb-1">Calificación</p>
                                                        <span class="font-w600 mb-2 d-block text-nowrap"><i class="fa-solid fa-heart';
                                                    if ($datos[$sc]['score_customers'] < 0) {
                                                        echo '-crack';
                                                    } else {
                                                        echo '';
                                                    }
                                                    echo        '" style="color:'; 
                                                    if ($datos[$sc]['score_customers'] < 0) {
                                                        echo 'black';
                                                    } else {
                                                        echo 'red';
                                                    }
                                                    echo '"></i> ' . $datos[$sc]['score_customers'] . '</span>
                                                    </div>
                                                </td>
                                            </tr>';
                                    }
                                }
                            @endphp
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="card-footer text-center border-0">
                                <a href="#" class="btn-link">See More >></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
