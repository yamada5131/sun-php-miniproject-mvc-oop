<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once(ROOT_DIR.'/app/views/templates/header.php');

?>

<div class="w-full min-h-screen bg-bluee pt-24">
    <div class="w-full max-w-6xl bg-white mx-auto my-0 rounded-xl pt-10 px-8 pb-10">
        <div class="flex items-center mb-6 justify-between">
            <h2 class="text-titletext text-xl font-bold mr-3">Production List</h2>

            <a href="?mod=product&act=add" role="button"
               class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 ">
                Add production
            </a>


        </div>
        <?php
        if (isset($_SESSION['success_message'])) {
            echo '<div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 " role="alert"><span class="font-medium">'.$_SESSION['success_message'].'</span></div>';
            unset($_SESSION['success_message']); // Clear the message
        }
        ?>

        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 ">
                <tr>
                    <th scope="col" class="p-4">
                        <div class="flex items-center">
                            <input id="checkbox-all-search" type="checkbox"
                                   class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 ">
                            <label for="checkbox-all-search" class="sr-only">checkbox</label>
                        </div>
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Product name
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Color
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Category
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Accessories
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Available
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Price
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Weight
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Action
                    </th>
                </tr>
                </thead>
                <tbody>
                <?php
                foreach ($products as $product) : ?>
                    <tr class="bg-white border-b hover:bg-gray-50 ">
                        <td class="w-4 p-4">
                            <div class="flex items-center">
                                <input id="checkbox-table-search-1" type="checkbox"
                                       class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                                <label for="checkbox-table-search-1" class="sr-only">checkbox</label>
                            </div>
                        </td>
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                            <?php
                            echo $product['name']; ?>
                        </th>
                        <td class="px-6 py-4">
                            <?php
                            echo $product['color']; ?>
                        </td>
                        <td class="px-6 py-4">
                            <?php
                            echo $product['category']; ?>
                        </td>
                        <td class="px-6 py-4">
                            <?php
                            echo $product['accessories']; ?>
                        </td>
                        <td class="px-6 py-4">
                            <?php
                            echo $product['available']; ?>
                        </td>
                        <td class="px-6 py-4">
                            <?php
                            echo $product['price']; ?>
                        </td>
                        <td class="px-6 py-4">
                            <?php
                            echo $product['weight']; ?>
                        </td>
                        <td class="flex items-center px-6 py-4">
                            <a href="?mod=product&act=edit&code=<?= $product['id']; ?>"
                               class="font-medium text-blue-600 hover:underline">Edit</a>
                            <!-- Add Modal HTML -->
                            <div id="popup-modal" tabindex="-1"
                                 class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                <div class="relative p-4 w-full max-w-md max-h-full">
                                    <div class="relative bg-white rounded-lg shadow">
                                        <button type="button"
                                                class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
                                                data-modal-hide="popup-modal">
                                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                 fill="none" viewBox="0 0 14 14">
                                                <path stroke="currentColor" stroke-linecap="round"
                                                      stroke-linejoin="round" stroke-width="2"
                                                      d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                            </svg>
                                            <span class="sr-only">Close modal</span>
                                        </button>
                                        <div class="p-4 md:p-5 text-center">
                                            <svg class="mx-auto mb-4 text-gray-400 w-12 h-12"
                                                 aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                                 viewBox="0 0 20 20">
                                                <path stroke="currentColor" stroke-linecap="round"
                                                      stroke-linejoin="round" stroke-width="2"
                                                      d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                                            </svg>
                                            <h3 class="mb-5 text-lg font-normal text-gray-500">Are
                                                you sure you want to delete this product?</h3>
                                            <button id="confirm-delete" data-modal-hide="popup-modal" type="button"
                                                    class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                                                Yes, I'm sure
                                            </button>
                                            <button data-modal-hide="popup-modal" type="button"
                                                    class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100">
                                                No, cancel
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Update Remove Button -->
                            <a href="#!" data-modal-target="popup-modal" data-modal-toggle="popup-modal"
                               data-product-id="<?= $product['id']; ?>"
                               class="remove-button font-medium text-red-600 hover:underline ms-3">Remove</a>

                        </td>
                    </tr>

                <?php
                endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/flowbite@2.4.1/dist/flowbite.min.js"></script>
<!-- Add JavaScript to Handle Modal Confirmation -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const removeButtons = document.querySelectorAll('.remove-button');
        let productIdToRemove = null;

        removeButtons.forEach(button => {
            button.addEventListener('click', function () {
                productIdToRemove = this.getAttribute('data-product-id');
            });
        });

        document.getElementById('confirm-delete').addEventListener('click', function () {
            if (productIdToRemove) {
                window.location.href = `?mod=product&act=remove&code=${productIdToRemove}`;
            }
        });
    });
</script>
</body>

