function educationCertificationComponent() {
    return {
        // Icons key and Type value must match!
        "icons": {
            "Education": "fa-solid fa-graduation-cap",
            "Certificate": "fa-solid fa-certificate"
        },

        "certifications": {},

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
            for (let education of data) {
                this.certifications[education.education_name] = {
                    "Type": education.education_type,
                    "Description": education.education_description
                }
            }
        }
    }
}