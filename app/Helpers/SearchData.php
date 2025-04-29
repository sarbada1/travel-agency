<?php

namespace App\Helpers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class SearchData
{
    protected Model $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function filter_by_criteria($criteria = 'search', $searchAbleFiled = []): Builder
    {
        $columns = $this->model->getFillable();
        $query = $this->model->query();
        foreach ($columns as $column) {
            if (in_array($column, $searchAbleFiled)) {
                $query->orWhere($column, 'like', '%' . $criteria . '%');
            }
        }
        return $query;
    }

  
    public function filter_by_exact($filters = []): Builder
    {
        $query = $this->model->query();
        
        foreach ($filters as $column => $value) {
            if (!empty($value)) {
                $query->where($column, $value);
            }
        }
        
        return $query;
    }
    
  
    public function filter_by_range($column, $min = null, $max = null): Builder
    {
        $query = $this->model->query();
        
        if ($min !== null) {
            $query->where($column, '>=', $min);
        }
        
        if ($max !== null) {
            $query->where($column, '<=', $max);
        }
        
        return $query;
    }

  
    public function filter_by_date_range($column, $days = null): Builder
    {
        $query = $this->model->query();
        
        if ($days !== null) {
            $date = now()->subDays($days);
            $query->where($column, '>=', $date);
        }
        
        return $query;
    }

 
    public function filter_by_multiple_values($column, $values = []): Builder
    {
        $query = $this->model->query();
        
        if (!empty($values)) {
            $query->whereIn($column, $values);
        }
        
        return $query;
    }
    
   
    public function apply_sorting($sortBy, $direction = 'asc'): Builder
    {
        $query = $this->model->query();
        return $query->orderBy($sortBy, $direction);
    }
    
   
    public function apply_filters($filters = []): Builder
    {
        $query = $this->model->query();
        
        if (!empty($filters['keyword']) && !empty($filters['searchable_fields'])) {
            $searchQuery = $this->filter_by_criteria($filters['keyword'], $filters['searchable_fields']);
            $query->where(function($q) use ($searchQuery) {
                $q->addNestedWhereQuery($searchQuery->getQuery());
            });
        }
        
        if (!empty($filters['location'])) {
            $query->where('location', 'like', '%' . $filters['location'] . '%');
        }
        
        if (!empty($filters['category'])) {
            $query->whereHas('categories', function($q) use ($filters) {
                $q->where('company_job_category_id', $filters['category']);
            });
        }
        
        if (!empty($filters['job_type'])) {
            $query->where('job_type', $filters['job_type']);
        }
        
        if (!empty($filters['experience_level']) && is_array($filters['experience_level'])) {
            $query->whereIn('experience_level', $filters['experience_level']);
        }
        
        if (!empty($filters['salary_min'])) {
            $query->where('salary_max', '>=', $filters['salary_min']);
        }
        
        if (!empty($filters['salary_max'])) {
            $query->where('salary_min', '<=', $filters['salary_max']);
        }
        
        if (!empty($filters['posted_days'])) {
            $date = now()->subDays($filters['posted_days']);
            $query->where('created_at', '>=', $date);
        }
        
        if (!empty($filters['company_id'])) {
            $query->where('company_id', $filters['company_id']);
        }
        
        if (!empty($filters['sort_by'])) {
            switch ($filters['sort_by']) {
                case 'newest':
                    $query->orderBy('created_at', 'desc');
                    break;
                case 'salary_high_low':
                    $query->orderBy('salary_max', 'desc')->orderBy('salary_min', 'desc');
                    break;
                case 'salary_low_high':
                    $query->orderBy('salary_min', 'asc')->orderBy('salary_max', 'asc');
                    break;
                case 'most_relevant':
                default:
                    $query->orderBy('created_at', 'desc');
                    break;
            }
        } else {
            $query->orderBy('created_at', 'desc');
        }
        
        return $query;
    }
}