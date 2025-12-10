function projectComponent() {
    return {
        "projects": {},

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
                    "Image": project.project_image_filename,
                    "Description": project.project_description,
                    "Link": project.project_repository
                }
            }
        }
    }
}