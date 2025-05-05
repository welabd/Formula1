form.addEventListener("submit", async (e) => {
  e.preventDefault();
  
  const formData = new FormData(form);
  const data = Object.fromEntries(formData.entries());

  // Client-side password match check
  if (data.password !== data.confirm_password) {
    document.getElementById("message").textContent = "Passwords don't match!";
    return;
  }

  try {
    const response = await fetch('http://localhost/my/register.php', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify(data)
    });

    const result = await response.json();
    
    if (!response.ok) {
      throw new Error(result.message || "Registration failed");
    }

    alert("Registration successful!");
    window.location.href = "MyProject.html";
    
  } catch (error) {
    console.error('Error:', error);
    document.getElementById("message").textContent = error.message;
  }
});