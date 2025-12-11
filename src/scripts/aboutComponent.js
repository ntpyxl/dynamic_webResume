function aboutMeComponent() {
    return {
        intro: "",
        motto: "",
        rawSubcategories: {},
        subcategories: {},

        temp_intro: "",
        temp_motto: "",
        temp_rawSubcategories: {},

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
                this.rawSubcategories[subcategory.subcategory_name] = subcategory.subcategory_content;
                this.subcategories[subcategory.subcategory_name] = subcategory.subcategory_content
                    .split(".")
                    .map(s => s.trim())
                    .filter(s => s.length > 0);
            }
        },

        openModal() {
            this.temp_intro = this.intro;
            this.temp_motto = this.motto;
            this.temp_rawSubcategories = JSON.parse(JSON.stringify(this.rawSubcategories));
        },

        async saveChanges() {
            this.intro = this.temp_intro;
            this.motto = this.temp_motto;
            this.rawSubcategories = this.temp_rawSubcategories;

            try { 
                const response = await fetch(`api/api.php`, {
                    method: "POST",
                    headers: { "Content-Type": "application/json" },
                    body: JSON.stringify({
                        "action": "saveData_AboutMe",
                        "data": {
                            "intro": this.temp_intro,
                            "motto": this.temp_motto,
                            "rawSubcategories": this.temp_rawSubcategories
                        }
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