<?php

if (isset($_SESSION['error_message'])) {
    echo '
<div class="alert alert-danger">'.$_SESSION['error_message'].'</div>';
    unset($_SESSION['error_message']); // Clear the message
}
require_once(ROOT_DIR.'/app/views/templates/header.php');

?>
<div class="w-full min-h-screen bg-bluee pt-24">
    <div class="w-full max-w-xl bg-white mx-auto my-0 rounded-xl pt-10 px-8 pb-10">
        <div class="flex items-center mb-6 justify-between">
            <form class="w-full max-w-xl mx-auto" action="?mod=product&act=update&code=<?= ($product['id']) ?>"
                  method="POST"
                  role="form"
                  enctype="multipart/form-data">
                <h2 class="text-titletext text-xl font-bold mr-3 mb-6">Update Product Detail</h2>

                <div class="relative z-0 w-full mb-5 group">

                    <input id="name"
                           class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                           placeholder=" " name="name" value="<?= ($product['name']) ?>" required/>
                    <label for="name"
                           class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Product
                        name</label>
                </div>
                <div class="relative z-0 w-full mb-5 group">
                    <input id="color"
                           class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                           placeholder=" " name="color" value="<?= ($product['color']) ?>" required/>
                    <label for="color"
                           class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Color</label>
                </div>
                <div class="relative z-0 w-full mb-5 group">
                    <input id="category"
                           class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                           placeholder=" " name="category" value="<?= ($product['category']) ?>" required/>
                    <label for="category"
                           class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Category</label>
                </div>
                <div class="grid md:grid-cols-2 md:gap-6">
                    <div class="relative z-0 w-full mb-5 group">


                        <label for="accessories" class="block mb-2 text-sm font-medium">
                            Accessories</label>
                        <select id="accessories" name="accessories"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">

                            <option value="Yes" <?=
                            (strtolower($product['accessories']) == "yes") ? "selected" : "" ?>>Yes
                            </option>
                            <option value="No"<?=
                            (strtolower($product['accessories']) == "no") ? "selected" : "" ?>>No
                            </option>

                        </select>

                    </div>
                    <div class="relative z-0 w-full mb-5 group">
                        <label for="available" class="block mb-2 text-sm font-medium">
                            Available</label>
                        <select id="available" name="available"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">

                            <option value="Yes" <?=
                            (strtolower($product['available']) == "yes") ? "selected" : "" ?>>Yes
                            </option>
                            <option value="No"<?=
                            (strtolower($product['available']) == "no") ? "selected" : "" ?>>No
                            </option>

                        </select></div>
                </div>
                <div class="relative z-0 w-full mb-5 group">
                    <input name="price" id="price"
                           class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                           placeholder=" " value="<?= $product['price'] ?>" required/>
                    <label for="price"
                           class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Price</label>
                </div>
                <div class="relative z-0 w-full mb-5 group">
                    <input name="weight" id="weigh"
                           class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                           placeholder=" " value="<?= $product['weight'] ?>" required/>
                    <label for="weigh"
                           class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Weight</label>
                </div>
                <button type="submit"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">
                    Update
                </button>
            </form>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/flowbite@2.4.1/dist/flowbite.min.js"></script>
</body>
