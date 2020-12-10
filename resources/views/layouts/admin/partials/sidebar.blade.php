<section>
    <!-- Left Sidebar -->
    <aside id="leftsidebar" class="sidebar">
        <!-- User Info -->
        <div class="user-info">
            <div class="image">
                <img src="{{Storage::disk('public')->url('profile/'.Auth::user()->image)}}" width="48" height="48" alt="User" />
            </div>
            <div class="info-container">
                <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{Auth::user()->name}}</div>
                <div class="email">{{Auth::user()->email}}</div>
                <div class="btn-group user-helper-dropdown">
                    <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
                    <ul class="dropdown-menu pull-right">
                        <li>
                            <a href="{{Auth::user()->role_id == 1 ? route('admin.settings') : route('author.settings')}}"><i class="material-icons">settings</i>Sttings</a>
                            
                        </li>
                        <li role="separator" class="divider"></li>
                        <li>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                            <i class="material-icons">input</i>
                            <span>Sign Out</span>
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- #User Info -->
        <!-- Menu -->
        <div class="menu">
            <ul class="list">
                <li class="header">MAIN NAVIGATION</li>
                @if (Request::is('admin*'))
                    <li class="{{Request::is('admin/dashboard') ? 'active':''}}">
                        <a href="{{route('admin.dashboard')}}">
                            <i class="material-icons">home</i>
                            <span>Home</span>
                        </a>
                    </li>
                    <li class="{{Request::is('admin/tag*') ? 'active':''}}">
                        <a href="{{route('admin.tag.index')}}">
                            <i class="material-icons">label</i>
                            <span>Tags</span>
                        </a>
                    </li>
                    <li class="{{Request::is('admin/category*') ? 'active':''}}">
                        <a href="{{route('admin.category.index')}}">
                            <i class="material-icons">apps</i>
                            <span>Categories</span>
                        </a>
                    </li>
                    <li class="{{Request::is('admin/post*') || Request::is('admin/pending/post') ? 'active':'' }}">
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">library_books</i>
                            <span>Posts</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="{{route('admin.post.index')}}">
                                    <span>All Posts</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{route('admin.post.pending')}}">
                                    <span>Pending Posts</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{route('admin.favorite.index')}}">
                                    <span>Favorite Posts</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="{{Request::is('admin/subscriber*') ? 'active':''}}">
                        <a href="{{route('admin.subscriber.index')}}">
                            <i class="material-icons">subscriptions</i>
                            <span>Subscriber</span>
                        </a>
                    </li>
                    <li class="{{Request::is('admin/comments') ? 'active':''}}">
                        <a href="{{route('admin.comments.index')}}">
                            <i class="material-icons">comments</i>
                            <span>Comments</span>
                        </a>
                    </li>
                    <li class="{{Request::is('admin/authors') ? 'active':''}}">
                        <a href="{{route('admin.author.index')}}">
                            <i class="material-icons">account_circle</i>
                            <span>Authors</span>
                        </a>
                    </li>
                    <li class="header">System</li>
                    <li class="{{Request::is('admin/settings') ? 'active':''}}">
                        <a href="{{route('admin.settings')}}">
                            <i class="material-icons">settings</i>
                            <span>Settings</span>
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                            <i class="material-icons">input</i>
                            <span>Logout</span>
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                    </li>
                @endif
                @if (Request::is('author*'))
                    <li class="{{Request::is('author/dashboard') ? 'active':''}}">
                        <a href="{{route('author.dashboard')}}">
                            <i class="material-icons">home</i>
                            <span>Home</span>
                        </a>
                    </li>
                    <li class="{{Request::is('author/post*') || Request::is('author/pending/post') ? 'active':'' }}">
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">library_books</i>
                            <span>Posts</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="{{route('author.post.index')}}">
                                    <span>All Posts</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{route('author.favorite.index')}}">
                                    <span>Favorite Posts</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="{{Request::is('author/comments') ? 'active':''}}">
                        <a href="{{route('author.comments.index')}}">
                            <i class="material-icons">comments</i>
                            <span>Comments</span>
                        </a>
                    </li>
                    <li class="header">System</li>
                    <li class="{{Request::is('author/settings') ? 'active':''}}">
                        <a href="{{route('author.settings')}}">
                            <i class="material-icons">settings</i>
                            <span>Settings</span>
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                            <i class="material-icons">input</i>
                            <span>Logout</span>
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                    </li>
                @endif
            </ul>
        </div>
        <!-- #Menu -->
        <!-- Footer -->
        <div class="legal">
            <div class="copyright">
                &copy; 2016 - 2017 <a href="javascript:void(0);">AdminBSB - Material Design</a>.
            </div>
            <div class="version">
                <b>Version: </b> 1.0.5
            </div>
        </div>
        <!-- #Footer -->
    </aside>
    <!-- #END# Left Sidebar -->
    <!-- Right Sidebar -->
    <aside id="rightsidebar" class="right-sidebar">
        <ul class="nav nav-tabs tab-nav-right" role="tablist">
            <li role="presentation" class="active"><a href="#skins" data-toggle="tab">SKINS</a></li>
            <li role="presentation"><a href="#settings" data-toggle="tab">SETTINGS</a></li>
        </ul>
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane fade in active in active" id="skins">
                <ul class="demo-choose-skin">
                    <li data-theme="red" class="active">
                        <div class="red"></div>
                        <span>Red</span>
                    </li>
                    <li data-theme="pink">
                        <div class="pink"></div>
                        <span>Pink</span>
                    </li>
                    <li data-theme="purple">
                        <div class="purple"></div>
                        <span>Purple</span>
                    </li>
                    <li data-theme="deep-purple">
                        <div class="deep-purple"></div>
                        <span>Deep Purple</span>
                    </li>
                    <li data-theme="indigo">
                        <div class="indigo"></div>
                        <span>Indigo</span>
                    </li>
                    <li data-theme="blue">
                        <div class="blue"></div>
                        <span>Blue</span>
                    </li>
                    <li data-theme="light-blue">
                        <div class="light-blue"></div>
                        <span>Light Blue</span>
                    </li>
                    <li data-theme="cyan">
                        <div class="cyan"></div>
                        <span>Cyan</span>
                    </li>
                    <li data-theme="teal">
                        <div class="teal"></div>
                        <span>Teal</span>
                    </li>
                    <li data-theme="green">
                        <div class="green"></div>
                        <span>Green</span>
                    </li>
                    <li data-theme="light-green">
                        <div class="light-green"></div>
                        <span>Light Green</span>
                    </li>
                    <li data-theme="lime">
                        <div class="lime"></div>
                        <span>Lime</span>
                    </li>
                    <li data-theme="yellow">
                        <div class="yellow"></div>
                        <span>Yellow</span>
                    </li>
                    <li data-theme="amber">
                        <div class="amber"></div>
                        <span>Amber</span>
                    </li>
                    <li data-theme="orange">
                        <div class="orange"></div>
                        <span>Orange</span>
                    </li>
                    <li data-theme="deep-orange">
                        <div class="deep-orange"></div>
                        <span>Deep Orange</span>
                    </li>
                    <li data-theme="brown">
                        <div class="brown"></div>
                        <span>Brown</span>
                    </li>
                    <li data-theme="grey">
                        <div class="grey"></div>
                        <span>Grey</span>
                    </li>
                    <li data-theme="blue-grey">
                        <div class="blue-grey"></div>
                        <span>Blue Grey</span>
                    </li>
                    <li data-theme="black">
                        <div class="black"></div>
                        <span>Black</span>
                    </li>
                </ul>
            </div>
            <div role="tabpanel" class="tab-pane fade" id="settings">
                <div class="demo-settings">
                    <p>GENERAL SETTINGS</p>
                    <ul class="setting-list">
                        <li>
                            <span>Report Panel Usage</span>
                            <div class="switch">
                                <label><input type="checkbox" checked><span class="lever"></span></label>
                            </div>
                        </li>
                        <li>
                            <span>Email Redirect</span>
                            <div class="switch">
                                <label><input type="checkbox"><span class="lever"></span></label>
                            </div>
                        </li>
                    </ul>
                    <p>SYSTEM SETTINGS</p>
                    <ul class="setting-list">
                        <li>
                            <span>Notifications</span>
                            <div class="switch">
                                <label><input type="checkbox" checked><span class="lever"></span></label>
                            </div>
                        </li>
                        <li>
                            <span>Auto Updates</span>
                            <div class="switch">
                                <label><input type="checkbox" checked><span class="lever"></span></label>
                            </div>
                        </li>
                    </ul>
                    <p>ACCOUNT SETTINGS</p>
                    <ul class="setting-list">
                        <li>
                            <span>Offline</span>
                            <div class="switch">
                                <label><input type="checkbox"><span class="lever"></span></label>
                            </div>
                        </li>
                        <li>
                            <span>Location Permission</span>
                            <div class="switch">
                                <label><input type="checkbox" checked><span class="lever"></span></label>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </aside>
    <!-- #END# Right Sidebar -->
</section>