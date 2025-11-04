# News Summarization API

![PHP](https://img.shields.io/badge/PHP-8.3%2B-blue?style=flat&logo=php)
![License](https://img.shields.io/github/license/PouyaniArmin/news-summarization-api)
![Status](https://img.shields.io/badge/status-actively%20developed-brightgreen)
![Stars](https://img.shields.io/github/stars/PouyaniArmin/news-summarization-api?style=social)

> A **modular PHP API** that fetches news from **GNews**, displays articles, and provides **extractive** and **AI-powered** summaries using **Hugging Face BART**.

## Table of Contents
- [Installation](#installation)
- [Setup](#setup)
- [Usage](#usage)
- [API Endpoints](#api-endpoints)
- [Examples](#examples)
- [Features](#features)
- [Project Structure](#project-structure)
- [License](#license)
- [Contact](#contact)

## Installation

```bash
git clone https://github.com/PouyaniArmin/news-summarization-api.git
cd news-summarization-api
composer install
```
## Setup

1. Copy example env:
```bash
cp .env.example .env
```
```bash
GNEWS_API_KEY=your_gnews_key_here
HF_INFERENCE_TOKEN=hf_xxxxxxxxxxxxxxxxxxxx
```
```bash
php -S localhost:8000 -t public
```
## Usage

Open the app in your browser:

- View the latest news articles  
- Click **“Summarize”** → extractive summary (top 5 sentences)  
- Click **“AI”** → AI-powered summary via **Hugging Face BART**

## Examples

### 1. Home Page (Browser)
→ Shows news cards with **Summarize** and **AI** buttons.

---

### 2. Extractive Summary
→ Returns HTML page with **top 5 sentences** from the first article.

---

### 3. AI Summary (via URL)
→ Fetches article, extracts content, sends to **Hugging Face BART**, returns AI summary.

**Sample AI Output (HTML):**
```html
<h2>AI Summary</h2>
<p>A new breakthrough in AI reasoning was announced, outperforming previous models...</p>
```
## Features

- **Real-time News Fetching** – Uses **GNews API** to retrieve the latest articles  
- **Extractive Summarization** – Extracts top 5 meaningful sentences using `TextSummraizer`  
- **AI-Powered Summarization** – Integrates **Hugging Face `facebook/bart-large-cnn`** via Inference API  
- **Smart Content Extraction** – Parses `<p>`, `<h1>`, `<h2>`, `<h3>` tags with cURL + DOM  
- **Responsive UI** – Built with **Bootstrap 5** for clean, mobile-friendly news cards  
- **Modular MVC-Inspired Architecture** – Clean separation: Controllers, Views, Core  
- **PSR-4 Autoloading** – Scalable and organized namespace structure  
- **Environment Configuration** – Secure API keys via `.env` (phpdotenv)  
- **Error Handling** – Centralized via `ErrorHandler` class  
- **Ready for Expansion** – Easy to add caching, multilingual support, or new models
## Project Structure
```bash
├── app/
│   ├── Controllers/          # Home, Summarize, AiSummary controllers
│   ├── Core/                 # Router, Request, Response, View, Config, PageContentFetcher
│   ├── Core/AI/              # SummaryAi (HF integration), AiBase
│   ├── utilities/            # ErrorHandler
│   └── views/
│       ├── layouts/main.php  # Main layout (Bootstrap navbar + {{content}})
│       ├── home.php          # News cards with Summarize/AI buttons
│       ├── summarize.php     # Extractive summary view
│       └── ai_summary.php    # AI summary view with status handling
```
> **Key Files**  
> - `public/index.php` → Boots the app and defines routes  
> - `app/Core/AI/SummaryAi.php` → Connects to Hugging Face BART  
> - `app/Core/PageContentFetcher.php` → Extracts clean text from URLs

## License

This project is licensed under the **[MIT License](LICENSE)** – see the `LICENSE` file for details.

---

## Contact

- **Author**: Armin Pouyani  
- **GitHub**: [@PouyaniArmin](https://github.com/PouyaniArmin)  
- **Project Status**: Actively Developed