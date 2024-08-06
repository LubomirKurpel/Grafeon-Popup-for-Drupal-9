<?php

namespace Drupal\grafeon_popup\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Cache\Cache;

class GrafeonPopupForm extends ConfigFormBase
{
    protected function getEditableConfigNames()
    {
        return ["grafeon_popup.settings"];
    }

    public function getFormId()
    {
        return "grafeon_popup_settings_form";
    }

    public function buildForm(array $form, FormStateInterface $form_state)
    {
        $config = $this->config("grafeon_popup.settings");

        $form["enabled"] = [
            "#type" => "checkbox",
            "#title" => $this->t("Enable Popup"),
            "#default_value" => $config->get("enabled"),
        ];

        $form["title"] = [
            "#type" => "textfield",
            "#title" => $this->t("Popup Title"),
            "#default_value" => $config->get("title"),
            "#required" => true,
        ];

        $form["message"] = [
            "#type" => "textarea",
            "#title" => $this->t("Popup Message"),
            "#default_value" => $config->get("message"),
            "#required" => true,
        ];

        $form["cookie_days"] = [
            "#type" => "number",
            "#title" => $this->t("Number of days to remember dismissal"),
            "#default_value" => $config->get("cookie_days") ?? 30,
            "#required" => true,
            "#min" => 1,
            "#description" => $this->t(
                'Enter the number of days to remember the user\'s dismissal of the popup.'
            ),
        ];

        return parent::buildForm($form, $form_state);
    }

    public function submitForm(array &$form, FormStateInterface $form_state)
    {
        $title = $form_state->getValue("title");
        $message = $form_state->getValue("message");

        // These should be strings; if arrays are returned, check form field definitions.
        if (is_array($title) || is_array($message)) {
            // Log an error or provide a fallback to prevent array usage.
            $title = implode(" ", $title); // Fallback example, combine array to string if needed.
            $message = implode(" ", $message); // Fallback example, combine array to string if needed.
        }

        // Create a hash of the current popup content to track changes.
        $version = hash("sha256", $title . $message);

        $this->config("grafeon_popup.settings")
            ->set("enabled", $form_state->getValue("enabled"))
            ->set("title", $title)
            ->set("message", $message)
            ->set("cookie_days", $form_state->getValue("cookie_days"))
            ->set("version", $version) // Store the version hash.
            ->save();

        // Clear the cache to ensure changes are applied immediately.
        Cache::invalidateTags(["config:grafeon_popup.settings"]);

        parent::submitForm($form, $form_state);
    }
}
