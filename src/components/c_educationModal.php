<div class="flex fixed inset-0 z-20 bg-black/50 backdrop-blur-sm justify-center items-center">
    <div class="max-w-[600px] max-h-4/5 overflow-y-auto bg-gray-800 px-6 py-4 rounded-xl shadow-xl relative">
        <div class="flex w-full justify-between">
            <p class="mr-3 mt-2 mb-1 font-light">
                Do you want to add this to Education and Certifications?
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
            @submit.prevent="submitCertificate"
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
                <p class="text-xl select-none cursor-default">Type</p>
                <select
                    x-model="form.Type"
                    class="border px-3 py-1 border-white bg-gray-800 rounded-2xl"
                    required>
                    <option value="Education" default>Education</option>
                    <option value="Certificate">Certificate</option>
                </select>
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
                            submitCertificate();
                            modalOpen = !modalOpen;
                            document.body.classList.remove('modal-open');
                        "
                    class="px-5 py-1 border-2 border-white rounded-4xl hover:bg-white hover:text-black duration-150 cursor-pointer select-none">
                    Submit
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