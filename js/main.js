document.addEventListener('DOMContentLoaded', () => {
  if (!botSettings) {
    console.error('No bot settings provided.');
  }

  const {
    botSecret,
    apiVersion,
    widgetType,
    language,
    colorSettings,
    exampleQuestions,
    title,
    buttonTexts,
    inputPlaceholder,
    usePrivacyConsent,
    privacyTexts,
    openLinksInNewTab,
    // backwards compatibility section
    // these top-level color attributes are no longer present in new versions
    // but in older ones the "colorSettings" attribute does not exist
    primaryColor,
    secondaryColor,
    primaryTextColor,
    secondaryTextColor,
    inputFieldTextColor,
    inputFieldBgColor,
  } = botSettings;

  const guidPattern = /^\w{8}-\w{4}-\w{4}-\w{4}-\w{12}$/;

  if (!botSecret.match(guidPattern)) {
    console.error('Bot secret is invalid.');
    return;
  }

  let lailo;

  const initSettings = {
    botSecret,
    apiVersion,
    language,
    generalSettings: {
      privacyConsentNeeded: !!usePrivacyConsent,
      openLinksInNewTab: !!openLinksInNewTab,
    },
    texts: {
      title,
      exampleQuestions,
      inputPlaceholder,
      buttonTexts,
      privacy: privacyTexts,
    },
    colorSettings: {
      primary: colorSettings?.primary ?? primaryColor,
      secondary: colorSettings?.secondary ?? secondaryColor,
      primaryText: colorSettings?.primaryText ?? primaryTextColor,
      secondaryText: colorSettings?.secondaryText ?? secondaryTextColor,
      inputFieldText: colorSettings?.inputFieldText ?? inputFieldTextColor,
      inputFieldBackground: colorSettings?.inputFieldBackground ?? inputFieldBgColor,
      background: colorSettings?.background ?? '#ffffff',
    },
  };

  switch (widgetType) {
    case 'tinyWidget':
      lailo = Lailo.initTinyWidget(initSettings);
      break;
    case 'halfScreenWidget':
      lailo = Lailo.initHalfScreenWidget(initSettings);
      break;
    case 'fullScreenWidget':
      lailo = Lailo.initFullScreenWidget(initSettings);
      break;
    default:
      console.error('Invalid widget type');
      break;
  }

  lailo
    .then(() => {
      console.log('Lailo AI Avatar initialized');
    })
    .catch((err) => console.error(err));
});
