require('dotenv').config();
const Telegraf = require('telegraf');
const Markup = require('telegraf/markup');
const api = require('covid19-api');
const COUNTRIES_LIST = require('./constants');

const bot = new Telegraf(process.env.BOT_TOKEN);

bot.start((ctx) =>
    ctx.reply(
        `
Привет ${ctx.message.from.first_name + ' ' + ctx.message.from.last_name}
Узнай статистику по коронавирусу.
Введи на английском название страны и получи статистику.
Посмотреть весь список стран можно командой /help.
`,
        Markup.keyboard([
            ['Russia', 'Uzbekistan'],
            ['US', 'Canada'],
        ])
        .oneTime()
        .resize()
        .extra()
    )
);

bot.help((ctx) => ctx.reply(COUNTRIES_LIST));

bot.on('text', async (ctx) => {
    let data = {};

    try {
        data = await api.getReportsByCountries(ctx.message.text);

        const formatedData = `
    <b>🌏Страна🌏: ${data[0][0].country.toUpperCase()}</b>\n
    <i>👿Случаи:</i> ${data[0][0].cases}\n
    <i>💀Смертей:</i> ${data[0][0].deaths}\n
    <i>💪Выздоровевших:</i> ${data[0][0].recovered}
    `;
        ctx.replyWithHTML(formatedData);
    } catch {
        ctx.reply('Вы неправильно написали название страны. Посмотрите /help');
    }
});

bot.launch();
// eslint-disable-next-line no-console
console.log('bot launched');