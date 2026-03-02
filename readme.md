# WordPress Developer Showcase

A curated collection of developer resources, examples, and demonstrations for WordPress 6.9 and beyond.

---

## 🎯 About

This repository serves as a comprehensive showcase for developers exploring the latest features, APIs, and capabilities introduced in WordPress 6.9 and future releases. Whether you're a seasoned WordPress developer or just getting started, you'll find practical examples and best practices to level up your development workflow.

---

## ✨ Features

> **🚧 TBD - Coming Soon**

---

## 📋 Requirements

- WordPress 6.9 or higher
- PHP 8.0+
- Node.js 18+ (for development)
- npm or yarn

---

## 🚀 Local Setup

> **🚧 TBD - Coming Soon**

---

## 📁 Repository Structure

The root of the repository is wp-content

```
├── themes/
├── plugins/
├── CONTRIBUTING.md
└── README.md
```

---

## 🚢 Deployment

Vendor folders for plugins and themes with a `composer.json` are built and deployed automatically via [`.github/workflows/deploy-vendors.yml`](.github/workflows/deploy-vendors.yml) on every push to `trunk` or `staging`. It can also be triggered manually via **Actions → Run workflow** in the GitHub UI.

The workflow uses [GitHub Environments](https://docs.github.com/en/actions/deployment/targeting-different-environments/using-environments-for-deployment) to keep production and staging credentials and server URLs separate. The active environment is selected automatically based on the branch:

| Branch | Environment |
|---|---|
| `trunk` | `production` |
| `staging` | `staging` |

### GitHub Repository Setup

**1. Create the environments**

Go to **Settings → Environments** and create two environments: `production` and `staging`.

**2. Add secrets to each environment**

Under each environment, add the following secrets (same names, different values):

| Name | Description |
|---|---|
| `SFTP_USER` | SFTP username for this environment |
| `SFTP_PASSWORD` | SFTP password for this environment |

The destination server and paths are hardcoded in the workflow file itself (`sftp://sftp.wp.com/htdocs/wp-content/...`).

---

### ➕ Adding a Plugin or Theme to the Deployment Workflow

To include a new plugin or theme in the automated vendor deployment:

**1. Edit [`.github/workflows/deploy-vendors.yml`](.github/workflows/deploy-vendors.yml)** and add two steps following the same pattern as the existing ones.

Add a `composer install` step:

```yaml
- name: Install dependencies (your-package-name)
  working-directory: plugins/your-package-name   # or themes/your-package-name
  run: composer install --no-dev --optimize-autoloader --no-interaction
```

Add an upload step immediately after:

```yaml
- name: Upload your-package-name vendor folder
  uses: Automattic/FTP-Deploy-Action@3.1.2
  with:
    ftp-server: sftp://sftp.wp.com/htdocs/wp-content/plugins/your-package-name/   # or themes/your-package-name/
    ftp-username: ${{ secrets.SFTP_USER }}
    ftp-password: ${{ secrets.SFTP_PASSWORD }}
    local-dir: plugins/your-package-name/vendor/   # or themes/your-package-name/vendor/
    git-ftp-args: --all
```

No additional secrets or variables are needed.

---

## 🤝 Contributing

We welcome contributions from the community! Whether it's fixing a bug, adding a new example, or improving documentation, your input is valuable.

**Please read our [CONTRIBUTING.md](CONTRIBUTING.md) for detailed information on:**

- Code of Conduct
- Development workflow
- Pull request process
- Coding standards
- How to report issues

---

## 📚 Resources

- [WordPress 6.9 Release Notes](https://wordpress.org/news/)
- [WordPress Developer Resources](https://developer.wordpress.org/)
- [Block Editor Handbook](https://developer.wordpress.org/block-editor/)
- [Theme Handbook](https://developer.wordpress.org/themes/)
- [Plugin Handbook](https://developer.wordpress.org/plugins/)

---

## 📄 License

This project is licensed under the [GPLv2 or later](LICENSE) - the same license as WordPress itself.

---

## 🙏 Acknowledgments

- The WordPress Core Team
- All contributors to this showcase
- The broader WordPress community

---

<p align="center">
  <strong>Built with ❤️ for the WordPress community</strong>
</p>

---

_Have questions or suggestions? Open an issue or start a discussion!_
