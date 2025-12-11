<div class="flex fixed inset-0 z-20 bg-black/50 backdrop-blur-sm justify-center items-center">
    <div class="max-w-[600px] max-h-4/5 overflow-y-auto bg-gray-800 px-6 py-4 rounded-xl shadow-xl relative">
        <div class="flex w-full justify-between">
            <p class="mr-3 mt-2 mb-1 font-light">
                Do you want to make changes to Technical Skills?
            </p>

            <div
                @click="
                    modalOpen = !modalOpen
                    document.body.classList.remove('modal-open');
                "
                class="flex w-10 h-10 p-2 text-2xl rounded-2xl justify-center hover:bg-gray-700 cursor-pointer select-none">
                <i class="fa-solid fa-xmark"></i>
            </div>
        </div>

        <form
            x-cloak
            @submit.prevent="saveChanges"
            class="flex flex-col py-3 gap-5">
            <div class="flex flex-col">
                <p class="w-full text-xl select-none cursor-default">Front-end</p>
                <textarea
                    x-model="temp_rawSubcategories['Front-end']"
                    class="border px-3 py-1 border-white rounded-2xl"
                    rows="3"
                    cols="75"
                    required>
                </textarea>
            </div>

            <div class="flex flex-col">
                <p class="w-full text-xl select-none cursor-default">Back-end</p>
                <textarea
                    x-model="temp_rawSubcategories['Back-end']"
                    class="border px-3 py-1 border-white rounded-2xl"
                    rows="3"
                    cols="75"
                    required>
                </textarea>
            </div>

            <div class="flex flex-col">
                <p class="w-full text-xl select-none cursor-default">Programming</p>
                <textarea
                    x-model="temp_rawSubcategories.Programming"
                    class="border px-3 py-1 border-white rounded-2xl"
                    rows="3"
                    cols="75"
                    required>
                </textarea>
            </div>

            <div class="flex w-full justify-end gap-3">
                <button
                    type="button"
                    @click="
                            saveChanges();
                            modalOpen = !modalOpen;
                            document.body.classList.remove('modal-open');
                        "
                    class="px-5 py-1 border-2 border-white rounded-4xl hover:bg-white hover:text-black duration-150 cursor-pointer select-none">
                    Save
                </button>

                <button
                    type="button"
                    @click="
                            modalOpen = !modalOpen;
                            document.body.classList.remove('modal-open');
                        "
                    class="px-5 py-1 border-2 border-white rounded-4xl hover:bg-white hover:text-black duration-150 cursor-pointer select-none">
                    Cancel
                </button>
            </div>
        </form>
    </div>
</div>