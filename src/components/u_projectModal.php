<div class="flex fixed inset-0 z-20 bg-black/50 backdrop-blur-sm justify-center items-center">
    <div class="max-w-[600px] max-h-4/5 overflow-y-auto bg-gray-800 px-6 py-4 rounded-xl shadow-xl relative">
        <div class="flex w-full justify-between">
            <p class="mr-3 mt-2 mb-1 font-light">
                Do you want to edit this Project?
            </p>

            <div
                @click="
                    closeModal();
                    updateModalOpen = !updateModalOpen
                    document.body.classList.remove('modal-open');
                "
                class="flex w-10 h-10 p-2 text-2xl rounded-2xl justify-center hover:bg-gray-700 cursor-pointer select-none">
                <i class="fa-solid fa-xmark"></i>
            </div>
        </div>

        <form
            x-cloak
            @submit.prevent="submitProject"
            class="flex flex-col py-3 gap-5">
            <div class="flex flex-col">
                <p class="text-xl select-none cursor-default">Title</p>
                <input
                    type="text"
                    x-model="form.Title"
                    class="border px-3 py-1 border-white rounded-2xl"
                    required>
                </input>
            </div>

            <div class="flex flex-col">
                <p class="text-xl select-none cursor-default">Image</p>
                <input
                    type="file"
                    accept="image/*"
                    id="itemImageField"
                    name="itemImage"
                    @change="handleImageFile"
                    class="ml-1 px-2 py-1 border rounded-2xl file:px-3 file:mr-2 file:border file:rounded-2xl cursor-pointer"
                    required>
            </div>

            <div class="flex flex-col mt-4 justify-center items-center">
                <p class="font-medium mb-2">Image Preview</p>
                <img
                    id="previewImage"
                    :src="previewImage"
                    class="w-[480px] h-[270px] object-contain rounded-xl border" />
            </div>

            <div class="flex flex-col">
                <p class="text-xl select-none cursor-default">Link</p>
                <input
                    type="text"
                    x-model="form.Link"
                    class="border px-3 py-1 border-white rounded-2xl"
                    required>
                </input>
            </div>

            <div class="flex flex-col">
                <p class="w-full text-xl select-none cursor-default">Description</p>
                <textarea
                    x-model="form.Description"
                    class="border px-3 py-1 border-white rounded-2xl"
                    rows="4"
                    cols="75"
                    required>
                </textarea>
            </div>

            <div class="flex w-full justify-end gap-3">
                <button
                    type="button"
                    @click="
                            saveProject();
                            updateModalOpen = !updateModalOpen;
                            document.body.classList.remove('modal-open');
                        "
                    class="px-5 py-1 border-2 border-white rounded-4xl hover:bg-white hover:text-black duration-150 cursor-pointer select-none">
                    Save
                </button>

                <button
                    type="button"
                    @click="
                            closeModal();
                            updateModalOpen = !updateModalOpen;
                            document.body.classList.remove('modal-open');
                        "
                    class="px-5 py-1 border-2 border-white rounded-4xl hover:bg-white hover:text-black duration-150 cursor-pointer select-none">
                    Cancel
                </button>
            </div>
        </form>
    </div>
</div>