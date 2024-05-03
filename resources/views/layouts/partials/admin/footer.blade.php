<footer class="main-footer">
    <footer>
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-md-3 mb-4">
                    <a class="mb-4 d-block" href="/">
                        <img class="img-fluid" width="60px" height="50px" style="max-width: 100px;" src="{{ asset(blogInfo()->blog_logo) }}" alt="{{ blogInfo()->blog_name }}">
                    </a>
                    <p>
                        Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt
                        ut labore et dolore magna aliquyam erat, sed diam voluptua.
                    </p>
                </div>

                <div class="col-lg-2 col-md-3 col-6 mb-4">
                    <h6 class="mb-4">Quick Links</h6>
                    <ul class="list-unstyled footer-list">
                        <li><a href="about.html">About</a></li>
                        <li><a href="contact.html">Contact</a></li>
                        <li><a href="privacy-policy.html">Privacy Policy</a></li>
                        <li><a href="terms-conditions.html">Terms Conditions</a></li>
                    </ul>
                </div>

                <div class="col-lg-2 col-md-3 col-6 mb-4">
                    <h6 class="mb-4">Social Links</h6>
                    <ul class="list-unstyled footer-list">
                        <li><a href="#">facebook</a></li>
                        <li><a href="#">twitter</a></li>
                        <li><a href="#">linkedin</a></li>
                        <li><a href="#">github</a></li>
                    </ul>
                </div>
            </div>
            <div class="scroll-top">
                <a href="javascript:void(0);" id="scrollTop"><i class="ti-angle-up"></i></a>
            </div>
            <div class="text-center">
                <p class="content">&copy; <script>document.write(new Date().getFullYear())</script> - Design &amp; Develop By <a href="/"
                        target="_blank">{{ blogInfo()->blog_name }}</a></p>
            </div>
        </div>
    </footer>
</footer>
