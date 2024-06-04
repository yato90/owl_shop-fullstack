import axios, { AxiosResponse } from "axios";
import baseURL from "./index";

//const baseURL: string | undefined = "http://localhost/api";

const api = axios.create({
  baseURL,
});

export interface Stuff {
  id: number;
  name: string;
  price: number;
  img: string;
  type: string;
  rating: number;
}

export interface StuffInfo {
  id: number;
  stuff_id: number;
  title: string;
  description: string;
}

export interface StuffFilters {
  id: number;
  name: string;
  price: number;
  img: string;
  type_id: number;
  rating: number;
  stuffInfo: StuffInfo[];
}

export const getAllStuff = async (): Promise<any> => {
  try {
    const response: AxiosResponse<any> = await api.get('/stuff');
    return response.data;
  } catch (error) {
    console.error('Error fetching stuff:', error);
    throw error;
  }
};

export const getBasketStuff = async (): Promise<any> => {
  try {
    const response: AxiosResponse<any> = await api.get('/stuff/basket',{
      headers: {
        'Authorization': `Bearer ${localStorage.getItem('token')}`
      }
    });
    const basketStuffs = response.data;
    const stuffs = basketStuffs.map((basketStuff: any) => basketStuff.stuff);
    return stuffs;
  } catch (error) {
    console.error('Error fetching stuff:', error);
    throw error;
  }
};
export const addToBusket = async (stuffId: number) => {
  try {
    await axios.post(`${baseURL}/add-to-busket`, {
      stuff_id: stuffId
    }, {
      headers: {
        'Authorization': `Bearer ${localStorage.getItem('token')}`
      }
    });
    alert('Товар добавлен в корзину');
  } catch (error) {
    console.error('Ошибка при добавлении товара в корзину', error);
    alert('Не удалось добавить товар в корзину');
  }
};
export const removeFromBasket = async (stuffId: number) => {
  try {
    await axios.delete(`${baseURL}/remove-from-basket/${stuffId}`, {
      headers: {
        'Authorization': `Bearer ${localStorage.getItem('token')}`
      }
    });
    alert('Товар удален из корзины');
  } catch (error) {
    console.error('Ошибка при удалении товара из корзины', error);
    alert('Не удалось удалить товар из корзины');
  }
  window.location.reload();
};

export const getFilteredStuff = async (filters: any): Promise<StuffFilters[]> => {
  try {
    const response: AxiosResponse<StuffFilters[]> = await api.get('/stuff/filter', { params: filters });
    return response.data;
  } catch (error) {
    console.error('Error fetching filtered stuff:', error);
    throw error;
  }
};

