import puppeteer from 'puppeteer';

(async () => {
    const browser = await puppeteer.launch({ headless: true });
    const page = await browser.newPage();

    await page.goto('http://books.toscrape.com/', { waitUntil: 'networkidle2' });

    const productElements = await page.$x('//article[@class="product_pod"]');
    const items = [];

    for (let element of productElements) {
        const [titleElement] = await element.$x('.//h3/a');
        const title = await titleElement.evaluate(el => el.getAttribute('title'));

        const [priceElement] = await element.$x('.//p[@class="price_color"]');
        const price = await priceElement.evaluate(el => el.textContent.trim());

        const [imageElement] = await element.$x('.//div[@class="image_container"]/a/img');
        const image = await imageElement.evaluate(el => el.getAttribute('src'));

        items.push({
            title,
            price,
            image: `http://books.toscrape.com/${image}`,
        });
    }

    await fetch('http://localhost:8000/api/store-books', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({ books: items }),
    });

    console.log('Books sent to Laravel!');
    await browser.close();
})();
