import puppeteer from 'puppeteer';

(async () => {
    const browser = await puppeteer.launch({ headless: false });
    const page = await browser.newPage();

    // Configura o user agent e navega para a página
    await page.setUserAgent('Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/85.0.4183.121 Safari/537.36');
    await page.goto('https://www.amazon.com/s?k=gaming+mouse', { waitUntil: 'networkidle2' });

    // Aguarde o carregamento dos produtos
    await page.waitForSelector('.s-main-slot');

    // Extraia os dados
    const products = await page.evaluate(() => {
        const items = [];
        document.querySelectorAll('.s-main-slot .s-result-item').forEach(item => {
            const title = item.querySelector('h2 a span')?.innerText;
            const priceWhole = item.querySelector('.a-price-whole')?.innerText;
            const priceFraction = item.querySelector('.a-price-fraction')?.innerText;
            const image = item.querySelector('.s-image')?.src;

            if (title && priceWhole && image) {
                items.push({
                    title,
                    price: `$${priceWhole}.${priceFraction || '00'}`,
                    image,
                });
            }
        });
        return items;
    });

    // Retorne o JSON como string
    console.log(JSON.stringify(products, null, 2));
    await browser.close();
})();
