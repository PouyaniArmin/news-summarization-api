# 📰 News Summarization API  

A lightweight PHP-based API that fetches news articles using the **GNews API** and generates short summaries of their content.  
Built with a modular architecture inspired by MVC for easy scalability and future AI model integration.
## ⚙️ Installation & Setup  
## ⚙️ Installation & Setup  

1. **Clone the repository:**  
2. **Install dependencies:**
3. **Run the project on a local server**

```bash
git clone https://github.com/PouyaniArmin/news-summarization-api.git
cd news-summarization-api
composer install
php -S localhost:8000 -t public
```
## 🚀 How It Works  

- **`/home`**  
  Fetches and displays the latest news articles from GNews API.  

- **`/api/{id}`**  
  Fetches the selected article by its ID, extracts the main content, and returns a summarized version of it.
## 🔑 API Key Setup  

This project uses the [GNews API](https://gnews.io/) to fetch news data.  
To make it work, you need to get a free API key:

1. Go to [https://gnews.io/](https://gnews.io/)  
2. Sign up for a free account  
3. Copy your API key  
4. Paste it inside the `.env` file as shown above
## 📂 Project Structure  
App/
 ├── Core/              # Core components (Router, Request, Controller, etc.)
 ├── Controllers/       # Controllers handling the main logic
 ├── Utilities/         # Utility and helper classes (like ErrorHandler)
 └── Views/             # View files (HTML/PHP templates)
.env                    # Environment variables (API keys)
composer.json           # PHP dependencies
public/index.php        # Application entry point

✅ **Author:** [Armin Pouyani](https://github.com/PouyaniArmin)  
📅 **Status:** Actively under development
