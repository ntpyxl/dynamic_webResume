function userComponent() {
    return {
        loginForm: { username: "", password: "" },

        async loginUser() {
            try { 
                const response = await fetch(`api/api.php`, {
                    method: "POST",
                    headers: { "Content-Type": "application/json" },
                    body: JSON.stringify({ "action": "loginUser", "data": this.loginForm }),
                });

            const result = await response.json();
            if (!response.ok || result.success === false) {
                throw new Error(result.message || "Request failed");
            }

            // TODO: SWAL modal here, THEN reload on confirm
            window.location.reload();

            } catch (error) {
                // TODO: SWAL modal here
                console.log(error);
            }
        },

        async logoutUser() {
            window.location.href = "logout.php";
        }
    }
}