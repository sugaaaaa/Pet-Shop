<footer>
    <div class="bg-[#131313] py-20">
        <div class="max-w-screen-xl mx-auto">
            <div style="background-image: url({{ url('image/footerbg.jpeg') }});" class="p-5">
                <div class="border-dashed border-2 border-gray-300 p-4 grid grid-cols-4 items-center">
                    <div>
                        <img src="{{asset('image/footerimg.png')}}" alt="">
                    </div>
                    <div class="col-span-3 text-gray-400 pr-5">
                        <h1 class="text-xl font-bold mb-4">ABOUT US</h1>
                        <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim adm.Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore.</p>
                        <hr class="h-2 w-20 mt-4">

                        <div class="mt-4 grid grid-cols-3 gap-5 items-center">
                            <div class="flex gap-4 items-center">
                                <div class="border border-gray-300 rounded-full">
                                    <i class="fa-solid fa-location-dot py-2 px-2.5"></i>
                                </div>
                                <h1>8901 Marmora Road, Glasgow D04 89 GR, New York</h1>
                            </div>
                            <div class="flex gap-4 items-center">
                                <div class="border border-gray-300 rounded-full">
                                    <i class="fa-solid fa-phone p-2"></i>
                                </div>
                                <h1 for="location">(+1) 866-540-3229 <br> (+1) 866-540-3229</label>
                            </div>
                            <div class="flex gap-4 items-center">
                                <div class="border border-gray-300 rounded-full">
                                    <i class="fa-solid fa-envelope p-2"></i>
                                </div>
                                <label for="location">support@plazathemes.com</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="grid grid-cols-3 text-gray-300 mt-10">
                <div>
                    <h1 class="text-xl font-bold mb-4">OUR SERVICE</h1>
                    <ul class="leading-loose">
                        <li>Supplies</li>
                        <li>Pet Treats</li>
                        <li>Pet Food</li>
                        <li>Healthcare</li>
                    </ul>
                </div>
                <div>
                    <h1 class="text-xl font-bold mb-4">INFOMATION</h1>
                    <ul class="leading-loose">
                        <li>About Us</li>
                        <li>Privacy Policy</li>
                        <li>Terms & Conditions</li>
                        <li>Contact Us</li>
                    </ul>
                </div>
                <div>
                    <h1 class="text-xl font-bold mb-4">OPENNING HOURS</h1>
                    <ul class="leading-loose">
                        <li>
                            <div class="flex justify-between">
                                <p>Monday - Friday</p>
                                <p>9:00 - 22:00</p>
                            </div>
                        </li>
                        <li>
                            <div class="flex justify-between">
                                <p>Saturday</p>
                                <p>10:00 - 24:00</p>
                            </div>
                        </li>
                        <li>
                            <div class="flex justify-between">
                                <p>Sunday</p>
                                <p>12:00 - 24:00</p>
                            </div>
                        </li>
                        <li>
                            <h1>Payment Methods</h1>
                            <div class="mt-4">
                                <img src="{{asset('image/payment.png')}}" alt="">
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    {{--  --}}
    <div class="bg-black py-5">
        <h1 class="text-gray-300 text-center">© 2024 PetSo0.com. All Rights Reserved.</h1>
    </div>
</footer>