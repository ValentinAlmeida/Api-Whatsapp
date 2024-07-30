export interface LoginData {
    email: string;
    senha: string;
}

export interface LoginResponse {
    token: string;
    user: {
        id: number;
        nome: string;
        email: string;
    };
}
