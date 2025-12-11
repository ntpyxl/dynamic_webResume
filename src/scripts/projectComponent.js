function projectComponent() {
    return {
        "projects": {},
        "tempProjects": {},

        form: {
            "Id": null,
            "Title": null,
            "Image": null,
            "ImageName": null,
            "Link": null,
            "Description": null
        },
        previewImage: "",

        async getData() {
            try { 
                const response = await fetch(`api/api.php`, {
                    method: "POST",
                    headers: { "Content-Type": "application/json" },
                    body: JSON.stringify({ "action": "getData_Projects" }),
                });

            const result = await response.json();
            if (!response.ok || result.success === false) {
                throw new Error(result.message || "Request failed");
            }

            return result.data;

            } catch (error) {
                console.log(error);
            }
        },

        async loadParseData(data) {
            for (let project of data) {
                this.projects[project.project_name] = {
                    "Id": project.id,
                    "Image": project.project_image_filename,
                    "Description": project.project_description,
                    "Link": project.project_repository
                }
            }
        },

        handleImageFile(event) {
            const file = event.target.files[0];
            if (file) {
                this.form.Image = file;
                this.previewImage = URL.createObjectURL(file);
            } else {
                this.form.Image = null;
                this.previewImage = '';
            }
        },

        async submitProject() {
            const formData = new FormData();
            formData.append("action", "uploadImage_Projects");
            formData.append("image", this.form.Image);

            try {
                const response = await fetch(`api/api.php`, {
                    method: "POST",
                    body: formData
                });

                const result = await response.json();

                if (!response.ok || !result.success) {
                    throw new Error(result.message || "Image upload failed");
                }

                this.form.ImageName = result.fileName;

            } catch (error) {
                console.error("Upload error:", error);
                return { success: false, message: error.message };
            }

            try { 
                const response = await fetch(`api/api.php`, {
                    method: "POST",
                    headers: { "Content-Type": "application/json" },
                    body: JSON.stringify({
                        "action": "createData_Projects",
                        "data": this.form
                    }),
                });

            const result = await response.json();
            if (!response.ok || result.success === false) {
                throw new Error(result.message || "Request failed");
            }

            this.getData().then(data => this.loadParseData(data));

            } catch (error) {
                console.log(error);
            }
        }
    }
}