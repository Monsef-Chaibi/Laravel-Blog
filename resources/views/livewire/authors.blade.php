<div class="container">
    <div class="row align-items-center">
        <div class="col-6">
            <h1 class="multiple-border">Authors</h1>
        </div>
        <div class="col-3 my-auto w-25">
            <div class="input-group">
                <div class="form-outline">
                    <input type="search" id="form1" class="form-control" placeholder="Search for author"
                        wire:model="search" />
                    <label class="form-label" for="form1">Search</label>
                </div>
                <span class="input-group-text border-0" id="search-addon">
                    <i class="fas fa-search"></i>
                </span>
            </div>
        </div>
        <div class="col-3 text-end">
            <a class="btn btn-app btn-primary h-100" data-bs-toggle="modal" data-bs-target="#add_author_modal">
                <i class="fas fa-plus"></i> Add Author
            </a>
        </div>
        <div class="content">
            <div class="container">
                <div class="row">
                    @forelse ($authors as $author)
                        <div class="col-lg-4">
                            <div class="text-center card-box">
                                <div class="member-card pt-2 pb-2">
                                    <div class="thumb-lg member-thumb mx-auto mb-4">
                                        <img src="{{ asset($author->picture) }}" class="img-thumbnail rounded"
                                            alt="profile-image" />
                                    </div>
                                    <div class="my-2">
                                        <h4>{{ $author->username }}</h4>
                                        <p class="text-muted">@ {{ $author->role }}
                                            <span> | </span>
                                            <span>
                                                <a href="#" class="text-pink">{{ $author->email }}</a>
                                            </span>
                                        </p>
                                    </div>
                                    <button type="button" wire:click.prevent="editAuthor({{ $author }})"
                                        data-bs-toggle="modal" data-bs-target="#edit_author_modal"
                                        class="btn btn-primary mt-3 btn-rounded waves-effect w-md waves-light">Edit
                                    </button>
                                    <button type="button"
                                        class="btn btn-danger mt-3 btn-rounded waves-effect w-md waves-light"
                                        data-bs-toggle="modal" data-bs-target="#delete_modal"
                                        wire:click.prevent="deleteAuthor({{ $author }})">Delete
                                    </button>
                                    <div class="mt-4">
                                        <div class="row">
                                            <div class="col-4">
                                                <div class="mt-3">
                                                    <h4>2563</h4>
                                                    <p class="mb-0 text-muted">Wallets Balance</p>
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="mt-3">
                                                    <h4>6952</h4>
                                                    <p class="mb-0 text-muted">Income amounts</p>
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="mt-3">
                                                    <h4>1125</h4>
                                                    <p class="mb-0 text-muted">Total Transactions</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end col -->
                    @empty
                        <div class="alert alert-danger">
                            <p>No Author Found</p>
                        </div>
                    @endforelse
                </div>
                <div class="row mb-4">
                    {{ $authors->links('livewire::bootstrap') }}
                </div>
            </div>
        </div>
        <!--Adding Author Modal -->
        <div wire:ignore.self class="modal fade" id="add_author_modal" tabindex="-1" aria-labelledby="add_author_label"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="add_author_label">Add Author</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form wire:submit.prevent="addAuthor">
                        <div class="modal-body">
                            <div class="row gap-2 p-2">
                                <!-- Username input -->
                                <div class="col">
                                    <label for="exampleInputEmail1" class="form-label">Name</label>
                                    <input type="text" id="exampleInputEmail1" class="form-control" wire:model="name"
                                        placeholder="Enter a name" />
                                    @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <!-- Username input -->
                                <div class="col">
                                    <label class="form-label" for="form1Example3">Username</label>
                                    <input type="text" id="form1Example3" class="form-control" wire:model="username"
                                        placeholder="Enter a username" />
                                    @error('username')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row p-2">
                                <!-- Name input -->
                                <div class="mb-2">
                                    <label class="form-label" for="form1Example1">Email address</label>
                                    <input type="email" id="form1Example1" class="form-control" wire:model="email"
                                        placeholder="exampleemail@gmail.com" />
                                    @error('email')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row px-4">
                                <label class="visually-show p-0" for="inlineFormSelectPref">Author Type</label>
                                <select class="form-select" wire:model="author_type">
                                    <option value="">-- No selected --</option>
                                    <option value="admin">Admin</option>
                                    <option value="author">Author</option>
                                </select>
                                @error('author_type')
                                    <span class="text-danger p-0">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="row p-4">
                                <label>Is direct publisher?</label>
                                <div class="btn-group p-0">
                                    <input type="radio" class="btn-check" id="option1"
                                        wire:model="direct_publisher" autocomplete="off" name="direct_publisher"
                                        value="0" />
                                    <label class="btn btn-secondary m-0" for="option1">No</label>

                                    <input type="radio" class="btn-check" wire:model="direct_publisher"
                                        id="option2" autocomplete="off" name="direct_publisher" value="1" />
                                    <label class="btn btn-secondary m-0" for="option2">Yes</label>
                                </div>
                                @error('direct_publisher')
                                    <span class="text-danger p-0">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal"
                                wire:click="resetForm">Close</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Editing Author Modal -->
        <div wire:ignore.self class="modal fade" id="edit_author_modal" tabindex="-1"
            aria-labelledby="edit_author_label" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="edit_author_label">Edit Author</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <form wire:submit.prevent="updateAuthor">
                        <input type="hidden" wire:model="selected_author_id" />
                        <div class="modal-body">
                            <div class="row gap-2 p-2">
                                <!-- Name input -->
                                <div class="col">
                                    <label for="exampleInputEmail1" class="form-label">Name</label>
                                    <input type="text" id="exampleInputEmail1" class="form-control"
                                        wire:model="name" placeholder="Enter a name" />
                                    @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <!-- Username input -->
                                <div class="col">
                                    <label class="form-label" for="form1Example3">Username</label>
                                    <input type="text" id="form1Example3" class="form-control"
                                        wire:model="username" placeholder="Enter a username" />
                                    @error('username')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row p-2">
                                <!-- Name input -->
                                <div class="mb-2">
                                    <label class="form-label" for="form1Example1">Email address</label>
                                    <input type="email" id="form1Example1" class="form-control" wire:model="email"
                                        placeholder="exampleemail@gmail.com" />
                                    @error('email')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row px-4">
                                <label class="visually-show p-0" for="inlineFormSelectPref">Author Type</label>
                                <select class="form-select" wire:model="author_type">
                                    <option value="admin">Admin</option>
                                    <option value="author">Author</option>
                                </select>
                                @error('author_type')
                                    <span class="text-danger p-0">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="row p-4">
                                <label>Is direct publisher?</label>
                                <div class="btn-group p-0">
                                    <input type="radio" class="btn-check" id="option1"
                                        wire:model="direct_publisher" autocomplete="off" name="direct_publisher"
                                        value="0" />
                                    <label class="btn btn-secondary m-0" for="option1">No</label>

                                    <input type="radio" class="btn-check" wire:model="direct_publisher"
                                        id="option2" autocomplete="off" name="direct_publisher" value="1" />
                                    <label class="btn btn-secondary m-0" for="option2">Yes</label>
                                </div>
                                @error('direct_publisher')
                                    <span class="text-danger p-0">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="row py-2 px-4">
                                <h5>Blocked</h5>
                                <div class="form-check form-switch" style="margin-left: 1rem">
                                    <input class="form-check-input text-danger" type="checkbox" role="switch"
                                        id="flexSwitchCheckChecked" wire:model="blocked" checked>
                                    <label class="form-check-label" for="flexSwitchCheckChecked"></label>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-secondary text-start"
                                data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div wire:ignore.self class="modal fade" id="delete_modal" tabindex="-1"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-sm">
                <form wire:submit.prevent="destroyAuthor">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            Are you sure?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-danger">Yes</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
