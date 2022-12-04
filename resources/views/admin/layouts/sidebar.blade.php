<?php
use App\Models\Post;
?>
<aside class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
        <div>
            <img src="{{asset('admin//images/logo-icon.png')}}" class="logo-icon" alt="logo icon">
        </div>
        <div>
            <a style="text-decoration: none" href="{{route('home')}}">
                <h4 class="logo-text">Apteka</h4>
            </a>
        </div>
        <div class="toggle-icon ms-auto"> <i class="bi bi-list"></i>
        </div>
    </div>
    <!--navigation-->
    <ul class="metismenu" id="menu">
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bi bi-grid-fill"></i>
                </div>
                <div class="menu-title">Post</div>
            </a>
            <ul>
                <li> <a href="{{route('post.header')}}?type={{Post::TYPE_POST}}"><i class="bi bi-circle"></i>Header</a>
                </li>
                <li> <a href="{{route('post.index')}}?type={{Post::TYPE_POST}}"><i class="bi bi-circle"></i>List</a>
                </li>
                <li> <a href="{{route('post.create')}}?type={{Post::TYPE_POST}}"><i class="bi bi-circle"></i>Create</a>
                </li>

            </ul>
        </li>
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bi bi-grid-fill"></i>
                </div>
                <div class="menu-title">Products</div>
            </a>
            <ul>
                <li> <a href="{{route('post.header')}}?type={{Post::TYPE_PRODUCT}}"><i class="bi bi-circle"></i>Header</a>
                </li>
                <li> <a href="{{route('post.index')}}?type={{Post::TYPE_PRODUCT}}"><i class="bi bi-circle"></i>List</a>
                </li>
                <li> <a href="{{route('post.create')}}?type={{Post::TYPE_PRODUCT}}"><i class="bi bi-circle"></i>Create</a>
                </li>

            </ul>
        </li>
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bi bi-grid-fill"></i>
                </div>
                <div class="menu-title">Stuffs</div>
            </a>
            <ul>
                <li> <a href="{{route('post.header')}}?type={{Post::TYPE_STUFF}}"><i class="bi bi-circle"></i>Header</a>
                </li>
                <li> <a href="{{route('post.index')}}?type={{Post::TYPE_STUFF}}"><i class="bi bi-circle"></i>List</a>
                </li>
                <li> <a href="{{route('post.create')}}?type={{Post::TYPE_STUFF}}"><i class="bi bi-circle"></i>Create</a>
                </li>

            </ul>
        </li>
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bi bi-grid-fill"></i>
                </div>
                <div class="menu-title">News</div>
            </a>
            <ul>
                <li> <a href="{{route('post.header')}}?type={{Post::TYPE_NEW}}"><i class="bi bi-circle"></i>Header</a>
                </li>
                <li> <a href="{{route('post.index')}}?type={{Post::TYPE_NEW}}"><i class="bi bi-circle"></i>List</a>
                </li>
                <li> <a href="{{route('post.create')}}?type={{Post::TYPE_NEW}}"><i class="bi bi-circle"></i>Create</a>
                </li>

            </ul>
        </li>
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bi bi-grid-fill"></i>
                </div>
                <div class="menu-title">Settings</div>
            </a>
            <ul>
                </li>
                <li> <a href="{{route('setting.index')}}"><i class="bi bi-circle"></i>List</a>
                </li>
                <li> <a href="{{route('setting.create')}}"><i class="bi bi-circle"></i>Create</a>
                </li>

            </ul>
        </li>
        <li>
            <a href="{{route('message.index')}}">
                <div class="parent-icon"><i class="bi bi-chat-left-text"></i>
                </div>
                <div class="menu-title">Messages</div>
            </a>
        </li>

    </ul>
    <!--end navigation-->
</aside>
