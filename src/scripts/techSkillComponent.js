function techSkillComponent() {
    return {
        subcategories: {},

        async getData() {
            try { 
                const response = await fetch(`api/api.php`, {
                    method: "POST",
                    headers: { "Content-Type": "application/json" },
                    body: JSON.stringify({ "action": "getData_TechSkill" }),
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
            for (let subcategory of data) {
                this.subcategories[subcategory.subcategory_name] = subcategory.subcategory_content
                    .split(".")
                    .map(s => s.trim())
                    .filter(s => s.length > 0);
            }
        }
    }
}