<?php

namespace App\Services;

class MalParserService
{
    /**
     * Parse raw MAL page text and extract anime data.
     */
    public function parse(string $rawText): array
    {
        $data = [];

        // Title - usually the first prominent heading
        $data['title'] = $this->extractTitle($rawText);
        
        // Japanese and English titles
        $data['title_japanese'] = $this->extractField($rawText, 'Japanese:');
        $data['title_english'] = $this->extractField($rawText, 'English:');
        
        // Information fields
        $data['type'] = $this->extractField($rawText, 'Type:');
        $data['episodes'] = $this->extractNumericField($rawText, 'Episodes:');
        $data['status'] = $this->extractField($rawText, 'Status:');
        $data['aired'] = $this->extractField($rawText, 'Aired:');
        $data['premiered'] = $this->extractField($rawText, 'Premiered:');
        $data['studios'] = $this->extractField($rawText, 'Studios:');
        $data['source'] = $this->extractField($rawText, 'Source:');
        $data['genres'] = $this->extractField($rawText, 'Genres:');
        $data['themes'] = $this->extractField($rawText, 'Themes:');
        $data['duration'] = $this->extractField($rawText, 'Duration:');
        $data['rating'] = $this->extractField($rawText, 'Rating:');
        
        // Score
        $data['mal_score'] = $this->extractScore($rawText);
        
        // Synopsis
        $data['synopsis'] = $this->extractSynopsis($rawText);
        
        // MAL URL
        $data['mal_url'] = $this->extractMalUrl($rawText);

        // Image URL from og:image meta tag
        $data['image_url'] = $this->extractImageUrl($rawText);

        // Clean up extracted values
        $data = $this->cleanData($data);

        return $data;
    }

    /**
     * Extract the anime title.
     */
    protected function extractTitle(string $text): ?string
    {
        // Try to match title from the page structure
        // Pattern: The title usually appears after "Log Horizon\nEdit\nLog Horizon" or similar
        // Or from og:title meta tag
        if (preg_match('/og:title"\s+content="([^"]+)"/', $text, $matches)) {
            return trim($matches[1]);
        }

        // Try to find title from the visible text pattern
        // Title often appears right before "Add to My List"
        if (preg_match('/^(.+?)(?:\r?\n)+Edit\r?\n/m', $text, $matches)) {
            $title = trim($matches[1]);
            if (strlen($title) > 2 && strlen($title) < 200) {
                return $title;
            }
        }

        return null;
    }

    /**
     * Extract a simple field value by its label.
     */
    protected function extractField(string $text, string $label): ?string
    {
        // Match "Label: Value" pattern, capturing until newline
        $escapedLabel = preg_quote($label, '/');
        if (preg_match('/' . $escapedLabel . '\s*\r?\n?\s*(.+?)(?:\r?\n)/s', $text, $matches)) {
            return trim($matches[1]);
        }
        
        // Also try inline pattern "Label: Value"
        if (preg_match('/' . $escapedLabel . '\s+(.+?)(?:\r?\n|$)/m', $text, $matches)) {
            return trim($matches[1]);
        }

        return null;
    }

    /**
     * Extract a numeric field value.
     */
    protected function extractNumericField(string $text, string $label): ?int
    {
        $value = $this->extractField($text, $label);
        if ($value && preg_match('/(\d+)/', $value, $matches)) {
            return (int) $matches[1];
        }
        return null;
    }

    /**
     * Extract the MAL score.
     */
    protected function extractScore(string $text): ?float
    {
        // Pattern: "Score: 7.901" or "Score: 7.90" or score-label with value
        if (preg_match('/Score:\s*(\d+\.\d+)/', $text, $matches)) {
            return round((float) $matches[1], 2);
        }

        // Pattern from ratingValue
        if (preg_match('/ratingValue["\s:]+(\d+\.\d+)/', $text, $matches)) {
            return round((float) $matches[1], 2);
        }

        return null;
    }

    /**
     * Extract synopsis text.
     */
    protected function extractSynopsis(string $text): ?string
    {
        // Try og:description first
        if (preg_match('/og:description"\s+content="([^"]+)"/', $text, $matches)) {
            $synopsis = html_entity_decode($matches[1], ENT_QUOTES, 'UTF-8');
            return trim($synopsis);
        }

        // Try to find Synopsis section
        if (preg_match('/Synopsis\s*\r?\n(.+?)(?:\r?\n\s*\r?\n|\[Written by)/s', $text, $matches)) {
            return trim($matches[1]);
        }

        return null;
    }

    /**
     * Extract MAL URL.
     */
    protected function extractMalUrl(string $text): ?string
    {
        if (preg_match('/(https?:\/\/myanimelist\.net\/anime\/\d+[^\s"\'<>]*)/', $text, $matches)) {
            return trim($matches[1]);
        }
        return null;
    }

    /**
     * Extract image URL from og:image.
     */
    protected function extractImageUrl(string $text): ?string
    {
        if (preg_match('/og:image"\s+content="([^"]+)"/', $text, $matches)) {
            return trim($matches[1]);
        }

        // Try data-src pattern for main image
        if (preg_match('/data-src="(https:\/\/cdn\.myanimelist\.net\/images\/anime\/[^"]+)"/', $text, $matches)) {
            return trim($matches[1]);
        }

        return null;
    }

    /**
     * Clean up extracted data.
     */
    protected function cleanData(array $data): array
    {
        // Clean type - extract just the type name
        if (!empty($data['type'])) {
            $types = ['TV', 'Movie', 'OVA', 'ONA', 'Special', 'Music'];
            foreach ($types as $type) {
                if (stripos($data['type'], $type) !== false) {
                    $data['type'] = $type;
                    break;
                }
            }
        }

        // Clean genres - remove extra whitespace
        if (!empty($data['genres'])) {
            $data['genres'] = preg_replace('/\s+/', ' ', $data['genres']);
        }

        // Clean themes
        if (!empty($data['themes'])) {
            $data['themes'] = preg_replace('/\s+/', ' ', $data['themes']);
        }

        // Clean studios
        if (!empty($data['studios'])) {
            $data['studios'] = preg_replace('/\s+/', ' ', trim($data['studios']));
        }

        // Clean premiered
        if (!empty($data['premiered'])) {
            $data['premiered'] = preg_replace('/\s+/', ' ', trim($data['premiered']));
        }

        // Remove null values
        return array_filter($data, fn($value) => $value !== null && $value !== '');
    }
}
