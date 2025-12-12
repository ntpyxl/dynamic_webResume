function educationCertificationComponent() {
    return {
        // Icons key and Type value must match!
        "icons": {
            "Education": "fa-solid fa-graduation-cap",
            "Certificate": "fa-solid fa-certificate"
        },

        certifications: {},

        form: {
            "Id": null,
            "Title": null,
            "Type": "Education",
            "Description": null
        },

        async getData() {
            try { 
                const response = await fetch(`api/api.php`, {
                    method: "POST",
                    headers: { "Content-Type": "application/json" },
                    body: JSON.stringify({ "action": "getData_Education" }),
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
            this.certifications = {};
            for (let education of data) {
                this.certifications[education.education_name] = {
                    "Id": education.id,
                    "Type": education.education_type,
                    "Description": education.education_description
                }
            }
        },

        openUpdateModal(title, details) {
            this.form.Id = details.Id;
            this.form.Title = title;
            this.form.Type = details.Type;
            this.form.Description = details.Description;           
        },

        closeModal() {
            this.form = {
                "Id": null,
                "Title": null,
                "Type": "Education",
                "Description": null
            }

        },

        async submitCertificate() {
            try { 
                const response = await fetch(`api/api.php`, {
                    method: "POST",
                    headers: { "Content-Type": "application/json" },
                    body: JSON.stringify({
                        "action": "createData_Education",
                        "data": this.form
                    }),
                });

                const result = await response.json();
                if (!response.ok || result.success === false) {
                    throw new Error(result.message || "Request failed");
                }

                this.getData().then(data => this.loadParseData(data));
                this.closeModal();

            } catch (error) {
                console.log(error);
            }
        },

        async saveCertificate() {
            try { 
                const response = await fetch(`api/api.php`, {
                    method: "POST",
                    headers: { "Content-Type": "application/json" },
                    body: JSON.stringify({
                        "action": "saveData_Education",
                        "data": this.form
                    }),
                });
                const result = await response.json();
                if (!response.ok || result.success === false) {
                    throw new Error(result.message || "Request failed");
                }

                this.getData().then(data => this.loadParseData(data));
                this.closeModal();

            } catch (error) {
                console.log(error);
            }
        },

        async deleteCertificate(certificate) {
            const formData = {
                certificate_id: certificate.Id,
            };

            try { 
                const response = await fetch(`api/api.php`, {
                    method: "POST",
                    headers: { "Content-Type": "application/json" },
                    body: JSON.stringify({
                        "action": "deleteData_Education",
                        "data": formData
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