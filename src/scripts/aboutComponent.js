function aboutMeComponent() {
    return {
        intro: "",
        motto: "",
        subcategories: {},

        async getData() {
            try { 
                const response = await fetch(`api/api.php`, {
                    method: "POST",
                    headers: { "Content-Type": "application/json" },
                    body: JSON.stringify({ "action": "getData_AboutMe" }),
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
            this.intro = data.about.find(item => item.content_type === "Intro").content;
            this.motto = data.about.find(item => item.content_type === "Motto").content;
            for (let subcategory of data.subcategories) {
                this.subcategories[subcategory.subcategory_name] = subcategory.subcategory_content
                    .split(".")
                    .map(s => s.trim())
                    .filter(s => s.length > 0);
            }
        }
    }
}