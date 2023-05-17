<form wire:submit.prevent="updateBlogSocialMedia()" method="POST">
    <div class="row">
        <div class="col-md-6">
            <div class="mb-3">
                <label class="form-label">Facebook</label>
                <input type="text" wire:model="url_facebook" class="form-control" placeholder="Facebook page URL" />
                <span class="text-danger">@error('url_facebook') {{ $message }} @enderror</span>
            </div>
        </div>
        <div class="col-md-6">
            <div class="mb-3">
                <label class="form-label">Instagram</label>
                <input type="text" wire:model="url_instagram" class="form-control" placeholder="Instagram page URL" />
                <span class="text-danger">@error('url_instagram') {{ $message }} @enderror</span>
            </div>
        </div>
        <div class="col-md-6">
            <div class="mb-3">
                <label class="form-label">Youtube</label>
                <input type="text" wire:model="url_youtube" class="form-control" placeholder="Youtube page URL" />
                <span class="text-danger">@error('url_youtube') {{ $message }} @enderror</span>
            </div>
        </div>
        <div class="col-md-6">
            <div class="mb-3">
                <label class="form-label">Twitter</label>
                <input type="text" wire:model="url_twitter" class="form-control" placeholder="Twitter page URL" />
                <span class="text-danger">@error('url_twitte') {{ $message }} @enderror</span>
            </div>
        </div>
        <div class="col-md-6">
            <div class="mb-3">
                <button type="submit" class="btn btn-primary">Save Changes</button>
            </div>
        </div>
    </div>
</form>
